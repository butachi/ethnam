<?php
// vim: foldmethod=marker
/**
 *  Ethna_SmartyPlugin_Test.php
 *
 *  @author     Yoshinari Takaoka <takaoka@beatcraft.com>
 *  @version    $Id$
 */

require_once ETHNA_BASE . '/class/Ethna_SmartyPlugin.php';

//{{{    Ethna_SmartyPlugin_Test
/**
 *  Test Case For Ethna_SmartyPlugin.php
 *
 *  @access public
 */
class Ethna_SmartyPlugin_Test extends Ethna_UnitTestBase
{
    // {{{ test_smarty_modifier_select
    function test_smarty_modifier_select()
    {
        $r = smarty_modifier_select('a', 'b');
        $this->assertNull($r);

        $r = smarty_modifier_select('a', 'a');
        $this->assertEqual($r, 'selected="selected"');
    }
    // }}}

    // {{{  test_smarty_modifier_checkbox
    function test_smarty_modifier_checkbox()
    {
        //  文字列型で0と空文字列以外は確実に checked
        $expected = 'checked="checked"';
        $actual = smarty_modifier_checkbox("hoge");
        $this->assertEqual($expected, $actual);

        $actual = smarty_modifier_checkbox("yes");
        $this->assertEqual($expected, $actual);

        $actual = smarty_modifier_checkbox("n");
        $this->assertEqual($expected, $actual);

        $actual = smarty_modifier_checkbox(1);  // numeric other than zero.
        $this->assertEqual($expected, $actual);

        $actual = smarty_modifier_checkbox(4.001);  // float
        $this->assertEqual($expected, $actual);

        //   0 と空文字列の場合はNULLになる
        $actual = smarty_modifier_checkbox(0);  // numeric zero
        $this->assertNULL($actual);

        $actual = smarty_modifier_checkbox(0.0);  // float zero
        $this->assertNULL($actual);

        $actual = smarty_modifier_checkbox("0");
        $this->assertNULL($actual);

        $actual = smarty_modifier_checkbox("");
        $this->assertNULL($actual);

        //   null や false も 0 や空文字列と同じ扱い
        $actual = smarty_modifier_checkbox(NULL);
        $this->assertNULL($actual);

        $actual = smarty_modifier_checkbox(false);
        $this->assertNULL($actual);

        //  array, object, resource も checkedにはしない
        $actual = smarty_modifier_checkbox(array());
        $this->assertNULL($actual);

        $actual = smarty_modifier_checkbox(new stdClass());
        $this->assertNULL($actual);
    }
    // }}}
}
// }}}

?>
