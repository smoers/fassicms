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
 *  Date : 16/12/20 13:02
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 16-12-20
 */

namespace App\Moco\Printer;


trait MocoCustomPageFormat
{
    private $page_format = array(
        'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
        'CropBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
        'BleedBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 205, 'ury' => 292),
        'TrimBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 200, 'ury' => 287),
        'ArtBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 195, 'ury' => 282),
        'Dur' => 3,
        'trans' => array(
            'D' => 1.5,
            'S' => 'Split',
            'Dm' => 'V',
            'M' => 'O'
        ),
        'Rotate' => 0,
        'PZ' => 1,
    );

    /**
     * @param MocoStickerModel $stickerModel
     */
    public function setCustomPageFormat(MocoStickerModel $stickerModel): void
    {
        $this->page_format['MediaBox']['urx'] = $stickerModel->w;
        $this->page_format['MediaBox']['ury'] = $stickerModel->h;
        $this->page_format['CropBox']['urx'] = $stickerModel->w;
        $this->page_format['CropBox']['ury'] = $stickerModel->h;
        $this->page_format['BleedBox']['urx'] = $stickerModel->w;
        $this->page_format['BleedBox']['ury'] = $stickerModel->h;
        $this->page_format['TrimBox']['urx'] = $stickerModel->w;
        $this->page_format['TrimBox']['ury'] = $stickerModel->h;
        $this->page_format['ArtBox']['urx'] = $stickerModel->w;
        $this->page_format['ArtBox']['ury'] = $stickerModel->h;
    }

    /**
     * @return array
     */
    public function getCustomPageFormat(): array
    {
        return $this->page_format;
    }

}
