<?php
/*
 * Copyright (c) 2020. MO Consult
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
 *  Date : 16/12/20 11:28
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 16-12-20
 */

namespace App\Moco\Printer;


class MocoSticker
{
    use MocoCustomPageFormat;

    protected $header = null;
    protected $part_number = null;
    protected $bar_code = null;
    protected $stickerModel;
    protected $pdf;

    /**
     * Sticker constructor.
     * @param array $stickerModel
     */
    public function __construct(MocoStickerModel $stickerModel)
    {
        $this->stickerModel = $stickerModel;
        $this->setCustomPageFormat($stickerModel);
        /**
         * Default
         */
        $this->pdf = new \TCPDF();
        $this->pdf->setCreator('Fassi Belgium');
        $this->pdf->SetAuthor('MO Consult');
        $this->pdf->setTitle('Fiche de travail');
        $this->pdf->setPageUnit('mm');
        $this->pdf->setMargins(0,0);
        $this->pdf->setPrintHeader(false);
    }

    /**
     * @param null $header
     */
    public function setStickerHeader($header): void
    {
        $this->header = $header;
    }

    /**
     * @param null $part_number
     */
    public function setStickerPartNumber($part_number): void
    {
        $this->part_number = $part_number;
    }

    /**
     * @param null $bar_code
     */
    public function setStickerBarCode($bar_code): void
    {
        $this->bar_code = $bar_code;
    }

    public function generate()
    {
        $this->pdf->setAutoPageBreak(true);
        $this->pdf->setFont('helvetica','',8);
        $this->pdf->addPage('L',$this->getCustomPageFormat());
        $style = array(
            'position' => 'C',
            'align' => 'C',
            'stretch' => true,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false, // border
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true, // whether to display the text below the barcode
            'font' => 'helvetica', //font
            'fontsize' => 6, //font size
            'stretchtext' => 6,
            'label' => $this->bar_code,
        );

        $this->pdf->text($this->stickerModel->hex,$this->stickerModel->hey,$this->header);
        $this->pdf->ln();
        $this->pdf->setFont('helvetica','B',12);
        $this->pdf->MultiCell( $this->stickerModel->pnw,$this->stickerModel->pnh,$this->part_number,0,'C',false,1,$this->stickerModel->pnx,$this->stickerModel->pny);
        $this->pdf->write1DBarcode($this->bar_code, 'C39E', $this->stickerModel->bcx, $this->stickerModel->bcy, $this->stickerModel->bcw, $this->stickerModel->bch, $this->stickerModel->xres, $style, 'N');

    }

    public function Output()
    {
        $this->pdf->Output('test.pdf');
    }


}
