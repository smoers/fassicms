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
 *  Date : 16/01/21 11:21
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 16-01-21
 */

namespace App\Moco\Printer;


use Faker\Provider\Image;
use Illuminate\Support\Facades\Storage;

class MocoPrintTemplate extends \TCPDF
{
    /**
     * Logo
     * @var string
     */
    public $logo = 'logo.png';
    /**
     * Titre
     * @var string
     */
    public $header_title = 'Fassi Belgium';
    /**
     * Font pour le titre
     * @var string
     */
    public $title_font_name = 'helvetica';
    /**
     * Type du font
     * @var string
     */
    public $title_font_type = 'B';
    /**
     * Taille du font
     * @var int
     */
    public $title_font_size = 20;
    /**
     * Texte à afficher à gauche dans l'entête
     * @var string
     */
    public $header_left_text = '';
    /**
     * Texte à afficher à droite dans l'entête
     * @var string
     */
    public $header_right_text = '';
    /**
     * Texte à afficher à gauche dans le pied de page
     * @var string
     */
    public $footer_left_text = '';
    /**
     * Texte à afficher au centre dans le pied de page
     * @var string
     */
    public $footer_center_text = '';
    /**
     * Texte à afficher à droite dans le pied de page
     * @var string
     */
    public $footer_right_text = '';
    /**
     * Font pour le texte
     * @var string
     */
    public $text_font_name = 'helvetica';
    /**
     * Type du font pour le texte
     * @var string
     */
    public $text_font_type = 'N';
    /**
     * Taille du font pour le texte
     * @var int
     */
    public $text_font_size = 10;
    /**
     * Afficher ou pas le numéro de page
     * @var bool
     */
    public $show_num_page = true;
    /**
     * Avec une entre l'entête, le pied de page et le corps du document
     * @var bool
     */
    public $with_line = true;
    /**
     * Taille de la ligne
     * @var float
     */
    public $with_line_size = 0.25;
    /**
     * Marge de l'entête
     * @var int
     */
    public $header_margin = 10;
    /**
     * Marge du pied de page
     * @var int
     */
    public $footer_margin = 20;
    /**
     * @var int
     */
    public $image_height = 10;
    /**
     * Position du curseur sur l'axe Y
     * après tracage de l'entête
     * @var int
     */
    public $Y_header = 0;
    /**
     * Les hauteurs de Cell
     * @var array
     */
    protected $table_height = array();
    /**
     * @var float
     */
    protected $line_coef = 1.25;


    /**
     * Construit l'entête du document
     */
    public function Header()
    {
        /**
         * Image
         */
        if ($this->logo != '') {
            $this->Image(Storage::path($this->logo), $this->getMargins()['left'], 10,'', $this->image_height, 'PNG', '', 'T');
            $this->Ln($this->image_height);
        }
        $split = $this->split(3);
        /**
         * Entête gauche
         */
        $this->setFont($this->text_font_name,$this->text_font_type,$this->text_font_size);
        array_push($this->table_height,$this->standardMultiCell($this->header_left_text,$split,0,'L'));
        /**
         * Titre
         */
        $this->setFont($this->title_font_name,$this->title_font_type,$this->title_font_size);
        array_push($this->table_height,$this->standardMultiCell($this->header_title,$split,0,'C'));
        /**
         * Entête droite
         */
        $this->setFont($this->text_font_name,$this->text_font_type,$this->text_font_size);
        array_push($this->table_height,$this->standardMultiCell($this->header_right_text,$split,0,'R'));
        /**
         * Ligne de fin d'entête
         */
        if ($this->with_line) {
            $this->Y_header = $this->GetY() + $this->getMaxCellHeight();
            $this->SetY($this->Y_header);
            $this->setLineWidth($this->with_line_size);
            $this->Line($this->GetX(),$this->GetY(),$this->getXMax(),$this->GetY());
        }
    }

    /**
     * Construit le pied de page
     */
    public function Footer()
    {
        /**
         * Calcule de la largeur de la cellule
         */
        $split = 0;
        if ($this->footer_left_text != '')
            $split++;
        if ($this->footer_center_text != '')
            $split++;
        if ($this->footer_right_text != '' || $this->show_num_page)
            $split++;
        $split = $this->split($split);
        /**
         * Trace la ligne
         */
        if ($this->with_line) {
            $this->setLineWidth($this->with_line_size);
            $this->Line($this->GetX(),$this->GetY(),$this->getXMax(),$this->GetY());
            $this->ln();
        }
        /**
         * Défini la police de caractère
         */
        $this->setFont($this->text_font_name,$this->text_font_type,$this->text_font_size);
        /**
         * Affiche la cellule de gauche si elle n'est pas vide
         */
        if ($this->footer_left_text != '')
            $this->standardMultiCell($this->footer_left_text,$split,0,'L',0);
        /**
         * Affiche la cellule du centre si elle n'est pas vide
         */
        if ($this->footer_center_text != '')
            $this->standardMultiCell($this->footer_center_text,$split,0,'C',0);
        /**
         * Affiche la cellule de droite si elle n'est pas vide
         */
        if ($this->footer_right_text != '') {
            $page = $this->show_num_page ? "\n\rPage ".$this->getPage().'/'.$this->getNumPages() : '';
            $this->standardMultiCell($this->footer_right_text.$page, $split, 0, 'R', 0);
        } elseif ($this->show_num_page){
            $this->standardMultiCell('Page '.$this->getPage().'/'.$this->getNumPages(),$split,0,'R',0);
        }
        $this->SetY($this->Y_header);
    }

    /**
     * Calcul la taille des cellule en entête et en pied de page
     *
     * @return float
     */
    public function split(int $value): float
    {
        return $this->getBodyWidth() / $value;
    }

    public function splitByPercent(array $array): array
    {
        $return = [];
        foreach ($array as $value){
            array_push($return, $this->getBodyWidth() * ($value/100));
        }
        return $return;
    }

    /**
     * retourne la taille de corps de page
     * cad sans les marges
     *
     * @return float
     */
    public function getBodyWidth(): float
    {
        return $this->getPageWidth() - $this->getMargins()['left'] - $this->getMargins()['right'];
    }

    /**
     * Retourne la X maximun de la page
     * @return float
     */
    public function getXMax(): float
    {
        return $this->getPageWidth() - $this->getMargins()['left'];
    }

    /**
     * Affiche un texte et retourne la hauteur en mm de la cellule
     *
     * @param string $text
     * @param int $w
     * @param int $h
     * @param string $align
     * @param mixed $border
     * @return float
     */
    public function standardMultiCell(string $text, int $w, int $h = 0, string $align = 'L', $border = 0): float
    {
        $nbr = $this->MultiCell($w,$h,$text,$border,$align,false,0,'','',true,0,false,true,30,'T',false);
        return $nbr * $this->getLineHeight();
    }

    /**
     * Retourne la plus haute cellule dans la valeur contenue dans le tableau
     *
     * @return int|mixed
     */
    protected function getMaxCellHeight()
    {
        $max = 0;
        foreach($this->table_height as $value){
            if ($value > $max)
                $max = $value;
        };
        return $max;
    }

    /**
     * Retroune la hauteur du ligne en tenant compte de la taille de la police
     * et du coéficient de correction
     *
     * @return float
     */
    public function getLineHeight(): float
    {
        return $this->getFontSize() + $this->line_coef;
    }

}
