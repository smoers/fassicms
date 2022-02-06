<?php
/*
 * Copyright (c) 2022. MO Consult
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
 *  Date : 27/01/22 19:21
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 27-01-22
 */

namespace App\Moco\Printer;

use App\Moco\Common\MocoOptions;
use App\Models\Technician;
use Illuminate\Database\Eloquent\Collection;

class MocoTechniciansListCodebar
{
    use MocoSpotColor, MocoLabel, MocoFileName;

    /**
     * Classe chargée de l'impression en PDF
     * @var MocoPrintTemplate
     */
    protected MocoPrintTemplate $pdf;
    /**
     * Objet techniciens à imprimer
     * @var Collection
     */
    protected Collection $technicians;
    /**
     * tabelau des techniciens
     * @var array
     */
    protected array $printing= [];
    /**
     * paramêtres d'impression
     * @var MocoOptions
     */
    protected MocoOptions $options;


    /**
     * @param Collection $technicians
     */
    public function __construct(Collection $technicians, MocoOptions $options)
    {
        /**
         * Les paramêtres
         */
        $this->options = $options;
        /**
         * Tableau avec la liste des techniciens
         */
        $this->technicians = $technicians;
        /**
         * Création du document PDF
         */
        $this->pdf = new MocoPrintTemplate('P','mm','A4');
        /**
         * Metadata
         */
        $this->pdf->setCreator('Fassi Belgium');
        $this->pdf->SetAuthor('MO Consult');
        $this->pdf->setTitle('Barcode des techniciens');
        /**
         * Marge
         */
        $this->pdf->setMargins($this->options->margin_left,$this->options->margin_top,$this->options->margin_right);
        /**
         * Définition de l'entête
         */
        $this->pdf->title_font_size = 14;
        $this->pdf->header_title = trans("List of barcode technicians");
        /**
         * Définition du pied de page
         */
        $this->pdf->footer_margin = $this->options->footer_margin;
        $this->pdf->footer_left_text = trans('INTERNAL DOCUMENT');
        /**
         * Conf
         */
        $this->pdf->setAutoPageBreak(true);
        /**
         * Défini un spot color
         */
        $this->setSpotColor($this->pdf);
        /**
         * valeur par défaut pour le fill des cellules
         */
        $this->pdf->SetFillSpotColor($this::$WHITE);
    }

    public function build()
    {
        $this->pdf->addPage();
        $this->pdf->setCellPaddings($this->options->padding_left,$this->options->padding_top,$this->options->padding_right,$this->options->padding_bottom);
        /**
         * Positionne le curseur
         */
        $this->pdf->SetY($this->pdf->Y_header + $this->options->top_margin);
        /**
         * Défini la police et la taille
         */
        $this->pdf->setFont('helvetica','',$this->options->text_font_size);
        /**
         * Impression des nom et barcode
         */
        foreach ($this->technicians as $technician) {
            $this->printing($technician);
        }
        /**
         * On vide le tableau avec les techniciens à imprimer
         */
        $this->printing();

    }

    /**
     * Génére le fichier PDF
     *
     * @param string $dest
     */
    public function Output(string $dest = 'I')
    {
        $name = $this->getFormattedFileName(['Liste_Technicians']);
        $this->pdf->Output($name,$dest);
    }

    protected function printing(Technician $technician = null)
    {
        /**
         * Si la méthode a été appelée avec un objet Technician ont le place dans le tableau
         */
        if (!is_null($technician))
            array_push($this->printing,$technician);
        /**
         * Si on est arrivé au nombre d'item par ligne
         * ou si l'appel a été fait sans objet
         */
        if (count($this->printing) == $this->options->by_line || is_null($technician)){
            /**
             * On split la largeur de la page par le nombre d'item sur la ligne
             */
            $split = $this->pdf->split($this->options->by_line);
            /**
             * mémorise les position X pour les utiliser lors de l'impression des codes bare
             */
            $_X = [];
            /**
             * Première ligne avec le nom
             */
            foreach ($this->printing as $value){
                /**
                 * position X
                 */
                array_push($_X,$this->pdf->GetX());
                $this->pdf->MultiCellLimitedBold($value->firstname.' '.$value->lastname,$split,0,$this->options->align);
            }
            /**
             * Ligne suivante
             */
            $this->pdf->Ln();
            /**
             * mémorise le position Y pour les utiliser lors de l'impression des codes bare
             */
            $_Y = $this->pdf->GetY();
            /**
             * compteur pour parcourir le tableau des positions X
             */
            $count = 0;
            /**
             * deuxième ligne avec le barcode
             */
            foreach ($this->printing as $value){
                $this->pdf->write1DBarcode($value->number,$this->options->type_bc,$_X[$count],$_Y,$split,$this->options->height_bc,$this->options->width_bc,config('moco.print.barcode.style'),$this->options->align_bc);
                $count++;
            }
            /**
             * Ligne suivante avec un inter ligne
             */
            $this->pdf->Ln($this->options->inter_line);
            /**
             * reset le tableau avec les techniciens
             */
            $this->printing = [];
        }
    }




}
