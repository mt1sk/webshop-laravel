<?php

namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ModelImage
{
    public function saveImage(UploadedFile $file, $options = [])
    {
        $imageNumber = $options['image_num'] ?? 0;
        $id = $this->getId();
        $field = $options['field'] ?? $this->resolveFieldName($imageNumber);
        $originalDir = $options['original_dir'] ?? $this->resolveOriginalDir($imageNumber);

        if ($id) {
            $this->deleteImage(['image_num'=>$imageNumber, 'field'=>$field, 'original_dir'=>$originalDir]);

            $fileName = $id . "." . $file->extension();
            if ($file->storeAs($originalDir, $fileName, ['disk'=>'public'])) {
                $this->$field = $fileName;
                $this->save();
            }
        }
    }

    public function deleteImage($options = [])
    {
        $imageNumber = $options['image_num'] ?? 0;
        $id = $this->getId();
        $field = $options['field'] ?? $this->resolveFieldName($imageNumber);
        $originalDir = $options['original_dir'] ?? $this->resolveOriginalDir($imageNumber);

        if ($id && !empty($this->$field)) {
            Storage::disk('public')->delete($originalDir.'/'.$this->$field);

            $this->$field = null;
            $this->save();
        }
    }

    /**
     * Get path to show image
     * @return string
     */
    public function imageView($imageNumber = 0, $options = [])
    {
        return asset('/storage/'.$this->resolveOriginalDir($imageNumber)).'/'.$this->{$this->resolveFieldName($imageNumber)};
    }

    public function showImage($imageNumber = 0, $options = [])
    {
        $field = $this->resolveFieldName($imageNumber);
        return !empty($this->{$field}) ? $this->imageView($imageNumber, $options) : asset('/img/no-photo-available.png');
    }

    /**
     * Override list of original images directories
     * @return string|array
     */
    protected function originalDir()
    {
        return 'images';
    }

    /**
     * Override list of database fields with images
     * @return string|array
     */
    protected function fieldName()
    {
        return 'image';
    }

    protected abstract function getId();

    private function resolveOriginalDir($index = 0)
    {
        $dirs = (array)$this->originalDir();
        return empty($dirs) ? '' : $dirs[$index];
    }

    private function resolveFieldName($index = 0)
    {
        $fields = (array)$this->fieldName();
        return empty($fields) ? '' : $fields[$index];
    }
}