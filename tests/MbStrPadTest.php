<?php

use PHPUnit\Framework\TestCase;

class MbStrPadTest extends TestCase
{
    public function test_it_pads_a_single_byte_string()
    {
        $input = 'padme';
        $targetLength = 10;

        $this->assertEquals('-----padme', mb_str_pad($input, $targetLength, '-', STR_PAD_LEFT));
        $this->assertEquals('padme-----', mb_str_pad($input, $targetLength, '-', STR_PAD_RIGHT));
        $this->assertEquals('--padme---', mb_str_pad($input, $targetLength, '-', STR_PAD_BOTH));
    }

    public function test_it_pads_a_multi_byte_string()
    {
        $input = 'ᚹädmΕ漢字';
        $targetLength = 12;

        $this->assertEquals('-----ᚹädmΕ漢字', mb_str_pad($input, $targetLength, '-', STR_PAD_LEFT));
        $this->assertEquals('ᚹädmΕ漢字-----', mb_str_pad($input, $targetLength, '-', STR_PAD_RIGHT));
        $this->assertEquals('--ᚹädmΕ漢字---', mb_str_pad($input, $targetLength, '-', STR_PAD_BOTH));
    }

    public function test_it_pads_with_multiple_characters()
    {
        $input = 'ᚹädmΕ漢字';
        $targetLength = 12;

        $this->assertEquals('abcabᚹädmΕ漢字', mb_str_pad($input, $targetLength, 'abc', STR_PAD_LEFT));
        $this->assertEquals('ᚹädmΕ漢字abcab', mb_str_pad($input, $targetLength, 'abc', STR_PAD_RIGHT));
        $this->assertEquals('abᚹädmΕ漢字abc', mb_str_pad($input, $targetLength, 'abc', STR_PAD_BOTH));
    }

    public function test_it_pads_with_multiple_multibyte_characters()
    {
        $input = 'ᚹädmΕ漢字';
        $targetLength = 12;

        $this->assertEquals('aßcaßᚹädmΕ漢字', mb_str_pad($input, $targetLength, 'aßc', STR_PAD_LEFT));
        $this->assertEquals('ᚹädmΕ漢字aßcaß', mb_str_pad($input, $targetLength, 'aßc', STR_PAD_RIGHT));
        $this->assertEquals('aßᚹädmΕ漢字aßc', mb_str_pad($input, $targetLength, 'aßc', STR_PAD_BOTH));
    }

    public function test_it_uses_sane_defaults()
    {
        $input = 'padme';
        $targetLength = 10;

        $this->assertEquals('padme     ', mb_str_pad($input, $targetLength));
    }

    public function test_throws_an_exception_if_pad_type_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        mb_str_pad('padmenot', 10, ' ', 100);
    }
}
