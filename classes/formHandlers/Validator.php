<?php

namespace formHandlers;

class Validator
{
    // Set properties
    private $passed = false,
            $errors = array(),
            $success = null;

    /**
     * Set rules for validate
     *
     * @param $source       = POST|GET
     * @param array $items  = Rules
     *
     * @return $this
     */
    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                if (isset($source[$item])){
                    $value = $source[$item];
                } else {
                    $value = null;
                }

                if($rule === "name") {
                    $name = $rule_value;
                } else {
                    $name = $item;
                }

                switch ($rule) {
                    case "isRequired":
                        if(empty($value)) {
                            $this->addError("{$name} is een verplicht veld");
                        }
                    break;
                    case "minLength":
                        if(strlen($value) < $rule_value && !empty($value)) {
                            $this->addError("{$name} moet langer zijn dan {$rule_value} karakters");
                        }
                    break;
                    case "matchChars":
                        $rule_match = "/^[$rule_value]*$/";
                        $rule_value = str_replace("\\", "", $rule_value);

                        if(!preg_match($rule_match, $value)) {
                            $this->addError("{$name} mag alleen de karakters \" {$rule_value} \" bevatten.");
                        }
                    break;
                    case "notMatch":
                        if ($value == $rule_value) {
                            $this->addError("{$name} is verplicht.");
                        }
                    break;
                }
            }
        }

        if(empty($this->errors)) {
            $this->passed = true;

        }

        return $this;
    }

    /**
     * Add errors to error array
     *
     * @param string $error = message to display
     */
    private function addError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * Return ALL error messages
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Add success message
     *
     * @param $success
     */
    private function addSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * Display success message
     *
     * @return null
     */
    public function success()
    {
        return $this->success;
    }

    /**
     * Return with success message if passed
     *
     * @param string $message = message to display if user passed
     * @return bool
     */
    public function passed($message)
    {
        $this->addSuccess($message);
        return $this->passed;
    }

}
