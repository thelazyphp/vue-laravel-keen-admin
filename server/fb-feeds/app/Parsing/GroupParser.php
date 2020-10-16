<?php

namespace App\Parsing;

use App\Parsing\Facades\Rule;

class GroupParser
{
    /**
     * The array of rules for parser.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Register rules for parser.
     *
     * @return void
     */
    protected function registerRules()
    {
        $this->rules['name'] = Rule::find('.d2edcug0.hpfvmrgz.qv66sw1b.c1et5uql.rrkovp55.a8c37x1j.keod5gw0.nxhoafnm.aigsh9s9.embtmqzv.fe6kdd0r.mau55g9w.c8b282yb.hrzyx87i.m6dqt4wy.h7mekvxk.hnhda86s.oo9gr5id.hzawbc8m')->text();

        $this->rules['image'] = Rule::find('[data-imgperflogname="profileCoverPhoto"]')->attr('src');

        $this->rules['description'] = Rule::find('.kvgmc6g5.cxmmr5t8.oygrvhab.hcukyx3x.c1et5uql')->text();
    }
}
