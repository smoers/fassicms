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
 *  Date : 23/01/22 12:20
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 23-01-22
 */

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

abstract class AbstractWidgetCore extends AbstractWidget
{

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('widgets.widget-core', [
            'config' => $this->config(),
            'widget' => $this->widget(),
        ]);
    }

    /**
     * @return array
     */
    abstract protected function config(): array;

    abstract protected function widget(): string;

}
