<?php

namespace App\Payments;

use App\Order;
use Illuminate\Http\Request;
use TCPDF;

class ReceiptModule extends Module
{
    public function callback(Request $request, Order $order)
    {
        $name = $request->get('name');
        $address = $request->get('address');

        //create a FPDF object
        $pdf=new TCPDF();

        $pdf->setPDFVersion('1.6');
        $pdf->SetFont('dejavusanscondensed','',8);

        // params
        $recipient = $request->get('recipient');
        $inn = $request->get('inn');
        $account = $request->get('account');
        $bank = $request->get('bank');
        $bik = $request->get('bik');
        $correspondent_account = $request->get('correspondent_account');
        $banknote = $request->get('banknote');
        $pence = $request->get('pence');
        $order_id = $request->get('order_id');
        $amount = $request->get('amount');

        //set document properties
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->setPageOrientation('P');
        //set font for the entire document
        $pdf->SetTextColor(0,0,0);

        //set up a page
        $pdf->AddPage();
        $pdf->SetDisplayMode('real');

        $pdf->SetFontSize(8);

        // ширина квитанции
        $width = 190;
        // Высота половинки
        $height = 75;
        // ширина слушебного поля
        $field_width = 80;

        // Начальные координаты
        $x = 10;
        $y = 10;

        // Первая рамка
        $pdf->SetLineStyle(array('dash'=>2));
        $pdf->SetXY($x,$y);
        $pdf->Cell($width, $height,'',1, 0,'C',0);

        $pdf->SetXY($field_width+$x-40, $y+5);
        $pdf->Write(5,"Извещение".PHP_EOL);

        $pdf->SetXY($x+10, $height+$y-10);
        //Some test
        $pdf->Write(5,"Кассир".PHP_EOL);

        $pdf->SetXY($field_width, $y);
        $pdf->Cell($width-$field_width, $height,'','L', 0,'C',0);

        // Наименование
        $x = $field_width;

        $this->textfield($pdf, $x+2, $y+3, 110, $recipient, '(наименование получателя платежа)');

        // Инн получателя
        $y+=8;
        $this->textfield($pdf, $x+2, $y+3, 35, $inn, '(ИНН получателя платежа)');

        //  Номер счета получателя
        $x+=50;
        $this->textfield($pdf, $x+2, $y+3, 60, $account, '(номер счета получателя платежа)');


        // Банк получателя
        $x-=50;
        $y += 9;
        $this->textfield($pdf, $x+2, $y+3, 110, $bank, '(наименование банка получателя платежа)');

        // Бик
        $y += 12;
        $pdf->SetXY($x+2,$y);
        $pdf->SetFontSize(9);
        $pdf->Write(5, 'БИК');

        $this->textfield($pdf, $x+10, $y, 25, $bik, '');

        // Номер счета
        $x+=45;
        $this->textfield($pdf, $x+7, $y, 60, '№ '.$correspondent_account, '(номер кор./сч. банка получателя платежа)');

        // Назначение платежа
        $x-=45;
        $y+=8;
        $this->textfield($pdf, $x+2, $y, 53, 'Оплата заказа №'.$order_id, '(наименование платежа)');

        // Назначение платежа
        $x+=55;
        $this->textfield($pdf, $x+2, $y, 55, '', '(номер лицевого счета (код) плательщика)');

        // Фио плательщика
        $x-=55;
        $y += 9;
        $pdf->SetXY($x+2,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, 'Ф.И.О. плательщика');
        $pdf->SetXY($x+35,$y);
        $pdf->Write(5, $name);

        $this->textfield($pdf, $x+35, $y-1, 77, '', '');

        // Адрес плательщика
        $y += 5;
        $pdf->SetXY($x+2,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, 'Адрес плательщика');
        $pdf->SetXY($x+35,$y);
        $pdf->Write(5, $address);

        $this->textfield($pdf, $x+35, $y-1, 77, '', '');


        // Сумма платежа
        $y += 5;
        $pdf->SetXY($x+64,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, 'Сумма платежа:  ');
        $pdf->Write(5, floor($amount).' '.$banknote.' '.round(($amount*100-floor($amount)*100)).' '.$pence);


        //  Итого
        $y += 5;
        $pdf->SetXY($x+76,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, ' Итого:  ');
        $pdf->SetFontSize(9);
        $pdf->Write(5, floor($amount).' '.$banknote.' '.round(($amount*100-floor($amount)*100)).' '.$pence);
        $pdf->SetFontSize(8);


        // Подпись плательщика
        $this->textfield($pdf, $x+2, $y, 30, '', '(подпись плательщика)');

        #########################################
        #########################################
        #########################################
        $x=10;
        $y = $height+10;

        // Первая рамка
        $pdf->SetLineStyle(array('dash'=>2));
        $pdf->SetXY($x,$y);
        $pdf->Cell($width, $height,'','LBR', 0,'C',0);

        $pdf->SetFontSize(8);

        $pdf->SetXY($field_width+$x-40, $y+5);
        $pdf->Write(5,"Квитанция".PHP_EOL);

        $pdf->SetXY($x+10, $height+$y-10);
        $pdf->Write(5,"Кассир".PHP_EOL);

        $pdf->SetXY($field_width, $y);
        $pdf->Cell($width-$field_width, $height,'','L', 0,'C',0);

        // Наименование
        $x = $field_width;

        $this->textfield($pdf, $x+2, $y+3, 110, $recipient, '(наименование получателя платежа)');

        // Инн получателя
        $y+=8;
        $this->textfield($pdf, $x+2, $y+3, 35, $inn, '(ИНН получателя платежа)');

        //  Номер счета получателя
        $x+=50;
        $this->textfield($pdf, $x+2, $y+3, 60, $account, '(номер счета получателя платежа)');


        // Банк получателя
        $x-=50;
        $y += 9;
        $this->textfield($pdf, $x+2, $y+3, 110, $bank, '(наименование банка получателя платежа)');

        // Бик
        $y += 12;
        $pdf->SetXY($x+2,$y);
        $pdf->SetFontSize(9);
        $pdf->Write(5, 'БИК');

        $this->textfield($pdf, $x+10, $y, 25, $bik, '');

        // Номер счета
        $x+=45;
        $this->textfield($pdf, $x+7, $y, 60, '№ '.$correspondent_account, '(номер кор./сч. банка получателя платежа)');

        // Назначение платежа
        $x-=45;
        $y+=8;
        $this->textfield($pdf, $x+2, $y, 53, 'Оплата заказа №'.$order_id, '(наименование платежа)');

        // Назначение платежа
        $x+=55;
        $this->textfield($pdf, $x+2, $y, 55, '', '(номер лицевого счета (код) плательщика)');

        // Фио плательщика
        $x-=55;
        $y += 9;
        $pdf->SetXY($x+2,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, 'Ф.И.О. плательщика');
        $pdf->SetXY($x+35,$y);
        $pdf->Write(5, $name);

        $this->textfield($pdf, $x+35, $y-1, 77, '', '');

        // Адрес плательщика
        $y += 5;
        $pdf->SetXY($x+2,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, 'Адрес плательщика');
        $pdf->SetXY($x+35,$y);
        $pdf->Write(5, $address);

        $this->textfield($pdf, $x+35, $y-1, 77, '', '');


        // Сумма платежа
        $y += 5;
        $pdf->SetXY($x+64,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, 'Сумма платежа:  ');
        $pdf->Write(5, floor($amount).' '.$banknote.' '.round(($amount*100-floor($amount)*100)).' '.$pence);


        //  Итого
        $y += 5;
        $pdf->SetXY($x+76,$y);
        $pdf->SetFontSize(8);
        $pdf->Write(5, ' Итого:  ');
        $pdf->SetFontSize(9);
        $pdf->Write(5, floor($amount).' '.$banknote.' '.round(($amount*100-floor($amount)*100)).' '.$pence);
        $pdf->SetFontSize(8);

        // Подпись плательщика
        $this->textfield($pdf, $x+2, $y, 30, '', '(подпись плательщика)');

        //Output the document
        $pdf->Output('receipt.pdf','I');
        exit;
    }

    private function textfield($pdf, $x, $y, $width, $text, $undertext)
    {
        $pdf->SetXY($x,$y);
        $pdf->SetLineStyle(array('dash'=>0));
        $pdf->SetFontSize(9);
        $pdf->Write(5, $text);
        $pdf->Line($x+1, $y+5, $x+$width, $y+5);
        $pdf->SetXY($x, $y+4);
        $pdf->SetFontSize(7);
        $pdf->Write(5,"$undertext");
    }
}