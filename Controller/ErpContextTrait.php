<?php

namespace Erp\Bundle\CoreBundle\Controller;

trait ErpContextTrait
{
    use ErpAuthorizationTrait;

    protected function prepareContext($context)
    {
        $context = (array)$context;

        $context['actions'] = (isset($context['actions']))? (array)$context['actions'] : [];
        $context['links'] = (isset($context['links']))? (array)$context['links'] : [];

        return $context;
    }

    protected function prepareActions($actions, $obj)
    {
        $actions = (array)$actions;

        foreach ($actions as $action) {
            $removed = true;
            if ($this->grant($action, [$obj])) {
                $removed = false;
            }

            if ($removed) {
                $actions = array_diff($actions, [$action]);
            }
        }

        return array_values($actions);
    }
}
