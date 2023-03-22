<?php
    namespace Clet\Model\Primitive;

    /**
     * The application base class
     *
     * @internal
     */
    class Base
    {
        /**
         * Base construct
         *
         * @param array|object $defaults The key of each element determines the name of property
         */
        public function __construct(array|object $defaults = [])
        {
            if (!empty($defaults)) $this->set($defaults);
        }
        /**
         * Set the properties of this object with values specified in the array.
         *
         * @param array|object $properties The key of each element determines the name of the property.
         *
         * @return void
         * @uses \is_numeric()
         */
        protected function set(array|object $properties)
        : void
        {
            foreach ($properties as $property => $value)
            {
                /** Assign property to this class */
                if (!is_numeric($property)) $this->$property = $value;
            }
        }
    }
