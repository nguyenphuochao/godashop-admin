<?php
class ParamToACLActionService
{

    function getActionName($c, $a)
    {
        $actionName = "";
        switch ($c) {
            case 'product':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_PRODUCT;
                }

                if (in_array($a, ["edit", "update"])) {
                    $actionName = ACLService::EDIT_PRODUCT;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_PRODUCT;
                }

                if (in_array($a, ["delete"])) {
                    $actionName = ACLService::DELETE_PRODUCT;
                }
                break;
            case 'imageitem':
                if (in_array($a, ["index", "detail"])) {
                    $actionName = ACLService::VIEW_PRODUCT;
                }

                if (in_array($a, ["save", "delete", "deletes"])) {
                    $actionName = ACLService::EDIT_PRODUCT;
                }
                break;
            case 'staff':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_STAFF;
                }

                if (in_array($a, ["edit", "update", "active", "disable", "activeOrDisableMulti"])) {
                    $actionName = ACLService::EDIT_STAFF;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_STAFF;
                }
                break;
            case 'order':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_ORDER;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_ORDER;
                }

                if (in_array($a, ["edit", "detail", "confirm"])) {
                    $actionName = ACLService::EDIT_ORDER;
                }

                if (in_array($a, ["delete"])) {
                    $actionName = ACLService::DELETE_ORDER;
                }
                break;
            case 'customer':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_CUSTOMER;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_CUSTOMER;
                }

                if (in_array($a, ["edit", "update"])) {
                    $actionName = ACLService::EDIT_CUSTOMER;
                }

                if (in_array($a, ["delete", "deletes"])) {
                    $actionName = ACLService::DELETE_CUSTOMER;
                }
                break;
            case 'category':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_CATEGORY;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_CATEGORY;
                }

                if (in_array($a, ["edit", "update"])) {
                    $actionName = ACLService::EDIT_CATEGORY;
                }

                if (in_array($a, ["delete", "deletes"])) {
                    $actionName = ACLService::DELETE_CATEGORY;
                }
                break;
            case 'shippingfee':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_TRANSPORT;
                }

                if (in_array($a, ["edit", "update"])) {
                    $actionName = ACLService::EDIT_TRANSPORT;
                }
                break;
            case 'brand':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_BRAND;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_BRAND;
                }

                if (in_array($a, ["edit", "update"])) {
                    $actionName = ACLService::EDIT_BRAND;
                }

                if (in_array($a, ["delete", "deletes"])) {
                    $actionName = ACLService::DELETE_BRAND;
                }
                break;
            case 'status':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_STATUS;
                }

                if (in_array($a, ["edit", "update"])) {
                    $actionName = ACLService::EDIT_STATUS;
                }
                break;
            case 'newsletter':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_NEWSLETTER;
                }

                if (in_array($a, ["add", "save"])) {
                    $actionName = ACLService::ADD_NEWSLETTER;
                }

                if (in_array($a, ["sendMail", "send"])) {
                    $actionName = ACLService::EDIT_NEWSLETTER;
                }


                if (in_array($a, ["delete"])) {
                    $actionName = ACLService::DELETE_NEWSLETTER;
                }
                break;
            case 'comment':
                if (in_array($a, ["index"])) {
                    $actionName = ACLService::VIEW_COMMENT;
                }

                if (in_array($a, ["detail"])) {
                    $actionName = ACLService::EDIT_COMMENT;
                }
                break;

            default:
                # code...
                break;
        }
        return $actionName; // có quyền truy cập
    }
}
