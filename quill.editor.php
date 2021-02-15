<?php
/**
 * Quill WYSIWYG Editor.
 *
 * It transforms all the editable areas into the Quill inline editor.
 *
 * @author shoaiyb sysa <contact@shoaiybsysa.ga>
 */

global $Wcms;

if (defined('VERSION')) {
    $Wcms->addListener('js', 'QuillJS');
    $Wcms->addListener('css', 'QuillCSS');
    $Wcms->addListener('editable', 'QuillVariables');
}

function QuillVariables($contents) {
    global $Wcms;
    $content = $contents[0];
    $subside = $contents[1];

    $contents_path = $Wcms->getConfig('contents_path');
    if (!$contents_path) {
        $Wcms->setConfig('contents_path', $Wcms->filesPath);
        $contents_path = $Wcms->filesPath;
    }
    $contents_path_n = trim($contents_path, "/");
    if ($contents_path != $contents_path_n) {
        $contents_path = $contents_path_n;
        $Wcms->setConfig('contents_path', $contents_path);
    }
    $_SESSION['contents_path'] = $contents_path;

    return array($content, $subside);
}

function QuillJS($args) {
    global $Wcms;
    if ($Wcms->loggedIn) {
        $script = <<<EOT
        <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

EOT;
        $args[0] .= $script;
    }
    return $args;
}

function QuillCSS($args) {
    global $Wcms;
    if ($Wcms->loggedIn) {
        $script = <<<EOT
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
        <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
EOT;
        $args[0] .= $script;
    }
    return $args;
}
