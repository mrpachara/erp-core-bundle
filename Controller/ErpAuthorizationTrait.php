<?php

namespace Erp\Bundle\CoreBundle\Controller;

trait ErpAuthorizationTrait
{
    /** @var \Erp\Bundle\CoreBundle\Authorization\AbstractErpAuthorization */
    protected $authorization = null;

    protected function normalizeActionName(string $input)
    {
        $output = str_replace("-", "", ucwords($input, "-"));

        if(!(empty($output))) $output[0] = strtolower($output[0]);

        return $output;
    }

    protected function grant($actions, $params = null)
    {
        $actions = (array) $actions;
        if(!$this->authorization || empty($actions)) return false;

        try {
            foreach($actions as $action) {
                $action = $this->normalizeActionName($action);
                $params = (array)$params;
                if(!call_user_func_array([$this->authorization, $action], $params)) {
                    return false;
                }
            }
        } catch(\Exception $excp) {
            return false;
        }

        return true;
    }
}
