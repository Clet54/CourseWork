<?php
    namespace Clet\Interfaces;

    /**
     * Response interface
     */
    interface Response
    {
        /**
         * Handles HTTP request(s) boolean true means redirecting to another page.
         *
         * @return bool
         */
        public function handle_responses()
        : bool;
    }
