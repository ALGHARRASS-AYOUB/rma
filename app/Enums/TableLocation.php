<?php

namespace Illuminate\App\Enums;

enum TableLocation:string
{

    case Front = 'front';
    case Inside = 'inside';
    case InsideVIP = 'insidevip';
    case Outside = 'outside';

}

