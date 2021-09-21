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

    protected function grant($action, $params = null)
    {
        if(!$this->authorization) return false;

        $action = $this->normalizeActionName($action);
        $params = (array)$params;
        $result = false;
        try {
            if(call_user_func_array([$this->authorization, $action], $params)) {
                $result = true;
            }
        } catch(\Exception $excp) {
            //dump($excp);
        }

        return $result;
    }
}
