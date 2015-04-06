<?php
Config::Set('router.page.tmce4',"PluginTmce4_ActionTmce4");
$config = array();
$config['use_spellcheck'] = true;

$config['spellcheck_config'] = array(
    "engine" => "pspell", // enchant, pspell

    // Enchant options
    "enchant_dicts_path" => "./dicts",

    // PSpell options
    "pspell.mode" => "",
    "pspell.spelling" => "",
    "pspell.jargon" => "",
    "pspell.encoding" => ""
);

return $config;
?>