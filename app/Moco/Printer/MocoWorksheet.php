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
    protected $worksheet;
    protected $pdf;
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
        $this->pdf->header_title = "Fiche de travail";
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

    }

    public function build()
    {
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
        $this->pdf->standardMultiCell('Date',$split,0,'C',0);
        $this->pdf->standardMultiCell("Numéro/Nummer",$split,0,'C',0);
        $this->pdf->standardMultiCell("Code barre/Streepjescode",$split,0,'C',0);
        $this->pdf->Ln();
        $this->pdf->standardMultiCell($this->worksheet->date,$split,20,'C',0);
        $this->pdf->standardMultiCell($this->worksheet->number,$split,20,'C',0);
        $this->pdf->write1DBarcode($this->worksheet->number,'C39E','','',$split,15,0.2,config('moco.print.barcode.style'),'R');
        $this->pdf->Ln();
        /**
         * Information
         */
        $split = $this->pdf->splitByPercent([20,30,20,30]);
        $this->pdf->standardMultiCell('Modèle : ',$split[0],0,'R',0);
        $this->pdf->standardMultiCell($this->worksheet->crane()->get(),$split[1],0,'L',0);
    }

    public function Output()
    {
        $this->pdf->Output('test.pdf');
    }
}
