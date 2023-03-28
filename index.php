<?php
    /**
     * Academic Year 2022/23
     *
     * Module: Number CMM007
     * Module Title: Intranet Systems Development
     * Assessment Method Coursework: Software plus Report.
     * Application structure inspired by WhichBrowser.
     * Frontend structure is driven by Bootstrap by Twitter.
     * Sources: - jQuery, PHP documentation and users comments on the documentations, class lectures majorly.
     * @author Clet Chigozie Opara.
     */
    use Clet\Core;
    /** Add our class loader */
    require 'autoload.php';
    /** @var $core */
    $core = Core::instance();
    $core->responses->handle_responses();
    echo $core;


/** https://github.com/Clet54/CourseWork */
