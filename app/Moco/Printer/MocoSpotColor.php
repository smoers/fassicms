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
 *  Date : 23/01/21 10:47
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 23-01-21
 */

namespace App\Moco\Printer;


trait MocoSpotColor
{
    public static  $BLACK = 'black';
    public static  $LIGHT_GREY = 'light grey';
    public static  $GREY = 'grey';
    public static  $DARK_GREY = 'dark grey';
    public static  $RED = 'red';
    public static  $WHITE = 'white';

    public function setSpotColor(\TCPDF $pdf)
    {
        $pdf->AddSpotColor('black',100,100,100,100);
        $pdf->AddSpotColor('light grey',0,0,0,27);
        $pdf->AddSpotColor('grey',0,0,0,37);
        $pdf->AddSpotColor('dark grey',0,0,0,79);
        $pdf->AddSpotColor('red',0,100,100,0);
        $pdf->AddSpotColor('white',0,0,0,0);
    }

}
