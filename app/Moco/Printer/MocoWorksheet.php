<?php
/*
 * Copyright (c) 2021. MO Consult
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *
 *  Company : Fassi Belgium
 *  Developer : MO Consult
 *  Author : Moers Serge
 *  Date : 16/01/21 12:36
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 16-01-21
 */

namespace App\Moco\Printer;


use App\Models\Worksheet;
use PhpParser\Node\Scalar\LNumber;

class MocoWorksheet
{
    use MocoSpotColor;
    use MocoLabel;

    protected $worksheet;
    protected $pdf;
    protected $hours_grid = true;
    /**
     * Marge après l'entête
     * @var int
     */
    protected $top_margin = 5;

    /**
     * MocoWorksheet constructor.
     * @param $worksheet
     */
    public function __construct(Worksheet $worksheet)
    {
        /**
         * Worksheet
         */
        $this->worksheet = $worksheet;
        /**
         * Création du document PDF
         */
        $this->pdf = new MocoPrintTemplate('P','mm','A4');
        /**
         * Metadata
         */
        $this->pdf->setCreator('Fassi Belgium');
        $this->pdf->SetAuthor('MO Consult');
        $this->pdf->setTitle('Fiche de travail');
        /**
         * Marge
         */
        $this->pdf->setMargins(15,15,15);
        /**
         * Taille de la police
         */
        $this->pdf->text_font_size = 8;
        /**
         * Définition de l'entête
         */
        $this->pdf->header_title = "Fiche de travail / Werkblad";
        $this->pdf->header_left_text = config('moco.print.address');
        /**
         * Définition du pied de page
         */
        $this->pdf->footer_margin = 25;
        $this->pdf->footer_left_text = 'email : '.config('moco.print.email')."\n\rTVA/BTW : ".config('moco.print.tva')."\n\rBanque/Bank : ".config('moco.print.bank_account_1');
        /**
         * Conf
         */
        $this->pdf->setAutoPageBreak(true);
        $this->setSpotColor($this->pdf);

    }

    public function build()
    {
        $crane = $this->worksheet->crane()->first();
        $customer = $this->worksheet->customer()->first();
        $this->pdf->addPage();
        /**
         * Positionne le curseur
         */
        $this->pdf->SetY($this->pdf->Y_header + $this->top_margin);
        /**
         * Défini la police et la taille
         */
        $this->pdf->setFont('helvetica','',10);
        /**
         * Date, numéro et barcode
         */
        $split = $this->pdf->getBodyWidth() / 3;
        $this->pdf->MultiCellLimitedItalic('Date / Datum',$split,0,'C',0);
        $this->pdf->MultiCellLimitedItalic("Numéro / Nummer",$split,0,'C',0);
        $this->pdf->MultiCellLimitedItalic("Code barre / Streepjescode",$split,0,'C',0);
        $this->pdf->Ln();
        $this->pdf->MultiCellLimited($this->worksheet->date,$split,20,'C',0);
        $this->pdf->MultiCellLimitedBold($this->worksheet->number,$split,20,'C',0,$this::$RED);
        $this->pdf->write1DBarcode($this->worksheet->number,'C39E','','',$split,15,0.2,config('moco.print.barcode.style'),'R');
        $this->pdf->Ln(5);
        /*
         * Mémorise la position de départ
         */
        $_X = $this->pdf->GetX(); $_Y = $this->pdf->GetY();
        /**
         * Split la page en quatre en %
         */
        $split = $this->pdf->splitByPercent([15,30,20,35]);
        /**
         * Modèle, Nom du client
         */
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('Modèle','Model'),$split[0],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($crane->model,$split[1],0,'L',0);
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('Nom du client','Klantnaam'),$split[2],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($customer->name,$split[3],0,'L',0);
        $this->pdf->Ln($this->pdf->getMaxCellHeight() * $this->pdf->getLineHeight());
        /**
         * Plaque, Adresse
         */
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('Plaque','Plaat'),$split[0],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($crane->plate,$split[1],0,'L',);
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('Adresse','Adres'),$split[2],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited("$customer->address\n\r$customer->zipcode, $customer->city",$split[3],0,'L',0);
        $this->pdf->Ln($this->pdf->getMaxCellHeight() * $this->pdf->getLineHeight());
        /**
         * Numéro de série, téléphone
         */
        if (!is_null($customer->phone) && !is_null($customer->mobile)){
            $phone = "$customer->phone\n\r$customer->mobile";
        } else {
            $phone = $customer->phone.$customer->mobile;
        }
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('N° de série','Serienummer'),$split[0],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($crane->serial,$split[1],0,'L',0);
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('Tél / GSM','Telefoon / GSM'),$split[2],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($phone,$split[3],0,'L',0);
        $this->pdf->Ln($this->pdf->getMaxCellHeight() * $this->pdf->getLineHeight());
        /**
         * Empty, Mail
         */
        $this->pdf->MultiCellLimitedItalic('',$split[0],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited('',$split[1],0,'L',0);
        $this->pdf->MultiCellLimitedItalic('Mail : ',$split[2],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($customer->mail,$split[3],0,'L',0);
        $this->pdf->Ln($this->pdf->getMaxCellHeight() * $this->pdf->getLineHeight());
        /**
         * Empty, TVA
         */
        $this->pdf->MultiCellLimitedItalic('',$split[0],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited('',$split[1],0,'L',0);
        $this->pdf->MultiCellLimitedItalic($this->formatLabel('TVA','VAT'),$split[2],0,'R',0, $this::$DARK_GREY);
        $this->pdf->MultiCellLimited($customer->vat,$split[3],0,'L',0);
        $this->pdf->Ln($this->pdf->getMaxCellHeight() * $this->pdf->getLineHeight());
        /**
         * Dessine les cadres
         */
        $_W = $split[0] + $split[1];
        $_H = $this->pdf->GetY()-$_Y;
        $this->pdf->Rect($_X,$_Y,$_W,$_H);
        $_X = $_W + $this->pdf->getMargins()['left'];
        $_W = $split[2]+$split[3];
        $this->pdf->Rect($_X,$_Y,$_W,$_H);
        /**
         * On defini un cell padding pour la suite
         */
        $this->pdf->setCellPadding(2);
        /**
         * Remarques du client
         */
        $this->pdf->MultiCellLimitedItalic('Remarques du client / Opmerkingen van de klant :',$this->pdf->getBodyWidth(),0,'L',0,$this::$DARK_GREY);
        $this->pdf->Ln();
        $this->pdf->maxH = 35;
        $this->pdf->MultiCellLimited($this->worksheet->remarks,$this->pdf->getBodyWidth(),35,'L',1);
        $this->pdf->Ln();
        /**
         * Travail effectués
         */
        $this->pdf->MultiCellLimitedItalic('Travail effectué / Werk gemaakt :',$this->pdf->getBodyWidth(),0,'L',0,$this::$DARK_GREY);
        $this->pdf->Ln();
        $this->pdf->maxH = 55;
        $this->pdf->MultiCellLimited($this->worksheet->work,$this->pdf->getBodyWidth(),55,'L',1);
        $this->pdf->maxH = 0;
        $this->pdf->Ln();
        /**
         * on reset le Cell padding
         */
        $this->pdf->SetCellPadding(0);
        /**
         * Grille des heures
         */
        if ($this->hours_grid){
            $this->pdf->resetLastH();
            $this->pdf->Ln();
            /**
             * Split la page en six en %
             */
            $split = $this->pdf->splitByPercent([20,20,15,15,15,15]);
            $_H = 10;
            $this->pdf->maxH = $_H;
            $this->pdf->MultiCellLimitedItalic($this->formatLabel('Date','Datum','','/'),$split[0],$_H,'CM',1);
            $this->pdf->MultiCellLimitedItalic($this->formatLabel('Nom','Naam','','/'),$split[1],$_H,'CM',1);
            $this->pdf->MultiCellLimitedItalic($this->formatLabel('De','Van','','/'),$split[2],$_H,'CM',1);
            $this->pdf->MultiCellLimitedItalic($this->formatLabel('A','Tot','','/'),$split[3],$_H,'CM',1);
            $this->pdf->MultiCellLimitedItalic($this->formatLabel('De','Van','','/'),$split[4],$_H,'CM',1);
            $this->pdf->MultiCellLimitedItalic($this->formatLabel('A','Tot','','/'),$split[5],$_H,'CM',1);
            $this->pdf->Ln();
            $this->pdf->SetFontSize(15);
            for($i=1;$i<=4;$i++) {
                $this->pdf->MultiCellLimitedItalic('.... / .... / ....', $split[0], $_H, 'CB', 1);
                $this->pdf->MultiCellLimitedItalic('', $split[1], $_H, 'CM', 1);
                $this->pdf->MultiCellLimitedItalic('.... h ....', $split[2], $_H, 'CB', 1);
                $this->pdf->MultiCellLimitedItalic('.... h ....', $split[3], $_H, 'CB', 1);
                $this->pdf->MultiCellLimitedItalic('.... h ....', $split[4], $_H, 'CB', 1);
                $this->pdf->MultiCellLimitedItalic('.... h ....', $split[5], $_H, 'CB', 1);
                $this->pdf->Ln();
            }
        }

    }

    public function Output()
    {
        $this->pdf->Output('test.pdf');
    }
}
