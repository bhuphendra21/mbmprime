<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'TEC\\Tickets\\Assets' => $baseDir . '/src/Tickets/Assets.php',
    'TEC\\Tickets\\Commerce' => $baseDir . '/src/Tickets/Commerce.php',
    'TEC\\Tickets\\Commerce\\Abstract_Order' => $baseDir . '/src/Tickets/Commerce/Abstract_Order.php',
    'TEC\\Tickets\\Commerce\\Admin\\Featured_Settings' => $baseDir . '/src/Tickets/Commerce/Admin/Featured_Settings.php',
    'TEC\\Tickets\\Commerce\\Admin\\Notices' => $baseDir . '/src/Tickets/Commerce/Admin/Notices.php',
    'TEC\\Tickets\\Commerce\\Admin_Tables\\Attendees' => $baseDir . '/src/Tickets/Commerce/Admin_Tables/Attendees.php',
    'TEC\\Tickets\\Commerce\\Admin_Tables\\Orders' => $baseDir . '/src/Tickets/Commerce/Admin_Tables/Orders.php',
    'TEC\\Tickets\\Commerce\\Assets' => $baseDir . '/src/Tickets/Commerce/Assets.php',
    'TEC\\Tickets\\Commerce\\Attendee' => $baseDir . '/src/Tickets/Commerce/Attendee.php',
    'TEC\\Tickets\\Commerce\\Cart' => $baseDir . '/src/Tickets/Commerce/Cart.php',
    'TEC\\Tickets\\Commerce\\Cart\\Cart_Interface' => $baseDir . '/src/Tickets/Commerce/Cart/Cart_Interface.php',
    'TEC\\Tickets\\Commerce\\Cart\\Unmanaged_Cart' => $baseDir . '/src/Tickets/Commerce/Cart/Unmanaged_Cart.php',
    'TEC\\Tickets\\Commerce\\Checkout' => $baseDir . '/src/Tickets/Commerce/Checkout.php',
    'TEC\\Tickets\\Commerce\\Communication\\Email' => $baseDir . '/src/Tickets/Commerce/Communication/Email.php',
    'TEC\\Tickets\\Commerce\\Compatibility\\Events' => $baseDir . '/src/Tickets/Commerce/Compatibility/Events.php',
    'TEC\\Tickets\\Commerce\\Editor\\Metabox' => $baseDir . '/src/Tickets/Commerce/Editor/Metabox.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Archive_Attendees' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Archive_Attendees.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Backfill_Purchaser' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Backfill_Purchaser.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Decrease_Sales' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Decrease_Sales.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Decrease_Stock' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Decrease_Stock.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\End_Duplicated_Pending_Orders' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/End_Duplicated_Pending_Orders.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Flag_Action_Abstract' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Flag_Action_Abstract.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Flag_Action_Handler' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Flag_Action_Handler.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Flag_Action_Interface' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Flag_Action_Interface.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Generate_Attendees' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Generate_Attendees.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Increase_Sales' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Increase_Sales.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Increase_Stock' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Increase_Stock.php',
    'TEC\\Tickets\\Commerce\\Flag_Actions\\Send_Email' => $baseDir . '/src/Tickets/Commerce/Flag_Actions/Send_Email.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_Gateway' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_Gateway.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_Merchant' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_Merchant.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_REST_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_REST_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_Requests' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_Requests.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_Settings' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_Settings.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_Signup' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_Signup.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_Webhooks' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_Webhooks.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Abstract_WhoDat' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Abstract_WhoDat.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Gateway_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Gateway_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Merchant_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Merchant_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\REST_Endpoint_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/REST_Endpoint_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Requests_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Requests_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Signup_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Signup_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\Webhook_Event_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/Webhook_Event_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Contracts\\WhoDat_Interface' => $baseDir . '/src/Tickets/Commerce/Gateways/Contracts/WhoDat_Interface.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Manager' => $baseDir . '/src/Tickets/Commerce/Gateways/Manager.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Manual\\Assets' => $baseDir . '/src/Tickets/Commerce/Gateways/Manual/Assets.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Manual\\Gateway' => $baseDir . '/src/Tickets/Commerce/Gateways/Manual/Gateway.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Manual\\Hooks' => $baseDir . '/src/Tickets/Commerce/Gateways/Manual/Hooks.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Manual\\Order' => $baseDir . '/src/Tickets/Commerce/Gateways/Manual/Order.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Manual\\Provider' => $baseDir . '/src/Tickets/Commerce/Gateways/Manual/Provider.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Assets' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Assets.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Buttons' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Buttons.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Client' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Client.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Gateway' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Gateway.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Hooks' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Hooks.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Location\\Country' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Location/Country.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Merchant' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Merchant.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Provider' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Provider.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\REST' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/REST.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\REST\\On_Boarding_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/REST/On_Boarding_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\REST\\Order_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/REST/Order_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\REST\\Webhook_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/REST/Webhook_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Refresh_Token' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Refresh_Token.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Settings' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Settings.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Signup' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Signup.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Status' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Status.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Tickets_Form' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Tickets_Form.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Webhooks' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Webhooks.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Webhooks\\Events' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Webhooks/Events.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\Webhooks\\Handler' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/Webhooks/Handler.php',
    'TEC\\Tickets\\Commerce\\Gateways\\PayPal\\WhoDat' => $baseDir . '/src/Tickets/Commerce/Gateways/PayPal/WhoDat.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Application_Fee' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Application_Fee.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Assets' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Assets.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Gateway' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Gateway.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Hooks' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Hooks.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Merchant' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Merchant.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Payment_Intent' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Payment_Intent.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Payment_Intent_Handler' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Payment_Intent_Handler.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Provider' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Provider.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\REST' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/REST.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\REST\\Order_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/REST/Order_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\REST\\Return_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/REST/Return_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\REST\\Webhook_Endpoint' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/REST/Webhook_Endpoint.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Requests' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Requests.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Settings' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Settings.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Signup' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Signup.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Status' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Status.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Stripe_Elements' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Stripe_Elements.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Webhooks' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Webhooks.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Webhooks\\Account_Webhook' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Webhooks/Account_Webhook.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Webhooks\\Charge_Webhook' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Webhooks/Charge_Webhook.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Webhooks\\Events' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Webhooks/Events.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Webhooks\\Handler' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Webhooks/Handler.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\Webhooks\\Payment_Intent_Webhook' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/Webhooks/Payment_Intent_Webhook.php',
    'TEC\\Tickets\\Commerce\\Gateways\\Stripe\\WhoDat' => $baseDir . '/src/Tickets/Commerce/Gateways/Stripe/WhoDat.php',
    'TEC\\Tickets\\Commerce\\Hooks' => $baseDir . '/src/Tickets/Commerce/Hooks.php',
    'TEC\\Tickets\\Commerce\\Legacy_Compat' => $baseDir . '/src/Tickets/Commerce/Legacy_Compat.php',
    'TEC\\Tickets\\Commerce\\Models\\Attendee_Model' => $baseDir . '/src/Tickets/Commerce/Models/Attendee_Model.php',
    'TEC\\Tickets\\Commerce\\Models\\Order_Model' => $baseDir . '/src/Tickets/Commerce/Models/Order_Model.php',
    'TEC\\Tickets\\Commerce\\Models\\Ticket_Model' => $baseDir . '/src/Tickets/Commerce/Models/Ticket_Model.php',
    'TEC\\Tickets\\Commerce\\Module' => $baseDir . '/src/Tickets/Commerce/Module.php',
    'TEC\\Tickets\\Commerce\\Notice_Handler' => $baseDir . '/src/Tickets/Commerce/Notice_Handler.php',
    'TEC\\Tickets\\Commerce\\Order' => $baseDir . '/src/Tickets/Commerce/Order.php',
    'TEC\\Tickets\\Commerce\\Payments_Tab' => $baseDir . '/src/Tickets/Commerce/Payments_Tab.php',
    'TEC\\Tickets\\Commerce\\Promoter_Observer' => $baseDir . '/src/Tickets/Commerce/Promoter_Observer.php',
    'TEC\\Tickets\\Commerce\\Provider' => $baseDir . '/src/Tickets/Commerce/Provider.php',
    'TEC\\Tickets\\Commerce\\Reports\\Attendance_Totals' => $baseDir . '/src/Tickets/Commerce/Reports/Attendance_Totals.php',
    'TEC\\Tickets\\Commerce\\Reports\\Attendees' => $baseDir . '/src/Tickets/Commerce/Reports/Attendees.php',
    'TEC\\Tickets\\Commerce\\Reports\\Orders' => $baseDir . '/src/Tickets/Commerce/Reports/Orders.php',
    'TEC\\Tickets\\Commerce\\Reports\\Report_Abstract' => $baseDir . '/src/Tickets/Commerce/Reports/Report_Abstract.php',
    'TEC\\Tickets\\Commerce\\Repositories\\Attendees_Repository' => $baseDir . '/src/Tickets/Commerce/Repositories/Attendees_Repository.php',
    'TEC\\Tickets\\Commerce\\Repositories\\Order_Repository' => $baseDir . '/src/Tickets/Commerce/Repositories/Order_Repository.php',
    'TEC\\Tickets\\Commerce\\Repositories\\Tickets_Repository' => $baseDir . '/src/Tickets/Commerce/Repositories/Tickets_Repository.php',
    'TEC\\Tickets\\Commerce\\Settings' => $baseDir . '/src/Tickets/Commerce/Settings.php',
    'TEC\\Tickets\\Commerce\\Shortcodes\\Checkout_Shortcode' => $baseDir . '/src/Tickets/Commerce/Shortcodes/Checkout_Shortcode.php',
    'TEC\\Tickets\\Commerce\\Shortcodes\\Shortcode_Abstract' => $baseDir . '/src/Tickets/Commerce/Shortcodes/Shortcode_Abstract.php',
    'TEC\\Tickets\\Commerce\\Shortcodes\\Success_Shortcode' => $baseDir . '/src/Tickets/Commerce/Shortcodes/Success_Shortcode.php',
    'TEC\\Tickets\\Commerce\\Status\\Action_Required' => $baseDir . '/src/Tickets/Commerce/Status/Action_Required.php',
    'TEC\\Tickets\\Commerce\\Status\\Approved' => $baseDir . '/src/Tickets/Commerce/Status/Approved.php',
    'TEC\\Tickets\\Commerce\\Status\\Completed' => $baseDir . '/src/Tickets/Commerce/Status/Completed.php',
    'TEC\\Tickets\\Commerce\\Status\\Created' => $baseDir . '/src/Tickets/Commerce/Status/Created.php',
    'TEC\\Tickets\\Commerce\\Status\\Denied' => $baseDir . '/src/Tickets/Commerce/Status/Denied.php',
    'TEC\\Tickets\\Commerce\\Status\\Not_Completed' => $baseDir . '/src/Tickets/Commerce/Status/Not_Completed.php',
    'TEC\\Tickets\\Commerce\\Status\\Pending' => $baseDir . '/src/Tickets/Commerce/Status/Pending.php',
    'TEC\\Tickets\\Commerce\\Status\\Refunded' => $baseDir . '/src/Tickets/Commerce/Status/Refunded.php',
    'TEC\\Tickets\\Commerce\\Status\\Reversed' => $baseDir . '/src/Tickets/Commerce/Status/Reversed.php',
    'TEC\\Tickets\\Commerce\\Status\\Status_Abstract' => $baseDir . '/src/Tickets/Commerce/Status/Status_Abstract.php',
    'TEC\\Tickets\\Commerce\\Status\\Status_Handler' => $baseDir . '/src/Tickets/Commerce/Status/Status_Handler.php',
    'TEC\\Tickets\\Commerce\\Status\\Status_Interface' => $baseDir . '/src/Tickets/Commerce/Status/Status_Interface.php',
    'TEC\\Tickets\\Commerce\\Status\\Undefined' => $baseDir . '/src/Tickets/Commerce/Status/Undefined.php',
    'TEC\\Tickets\\Commerce\\Status\\Voided' => $baseDir . '/src/Tickets/Commerce/Status/Voided.php',
    'TEC\\Tickets\\Commerce\\Success' => $baseDir . '/src/Tickets/Commerce/Success.php',
    'TEC\\Tickets\\Commerce\\Ticket' => $baseDir . '/src/Tickets/Commerce/Ticket.php',
    'TEC\\Tickets\\Commerce\\Tickets_View' => $baseDir . '/src/Tickets/Commerce/Tickets_View.php',
    'TEC\\Tickets\\Commerce\\Traits\\Has_Mode' => $baseDir . '/src/Tickets/Commerce/Traits/Has_Mode.php',
    'TEC\\Tickets\\Commerce\\Utils\\Currency' => $baseDir . '/src/Tickets/Commerce/Utils/Currency.php',
    'TEC\\Tickets\\Commerce\\Utils\\Value' => $baseDir . '/src/Tickets/Commerce/Utils/Value.php',
    'TEC\\Tickets\\Event' => $baseDir . '/src/Tickets/Event.php',
    'TEC\\Tickets\\Hooks' => $baseDir . '/src/Tickets/Hooks.php',
    'TEC\\Tickets\\Provider' => $baseDir . '/src/Tickets/Provider.php',
    'TEC\\Tickets\\Settings' => $baseDir . '/src/Tickets/Settings.php',
    'Tribe\\Tickets\\Admin\\Manager\\Service_Provider' => $baseDir . '/src/Tribe/Admin/Manager/Service_Provider.php',
    'Tribe\\Tickets\\Admin\\Settings\\Service_Provider' => $baseDir . '/src/Tribe/Admin/Settings/Service_Provider.php',
    'Tribe\\Tickets\\Editor\\Warnings' => $baseDir . '/src/Tribe/Editor/Warnings.php',
    'Tribe\\Tickets\\Events\\Attendees_List' => $baseDir . '/src/Tribe/Events/Attendees_List.php',
    'Tribe\\Tickets\\Events\\Service_Provider' => $baseDir . '/src/Tribe/Events/Service_Provider.php',
    'Tribe\\Tickets\\Events\\Views\\V2\\Hooks' => $baseDir . '/src/Tribe/Events/Views/V2/Hooks.php',
    'Tribe\\Tickets\\Events\\Views\\V2\\Models\\Tickets' => $baseDir . '/src/Tribe/Events/Views/V2/Models/Tickets.php',
    'Tribe\\Tickets\\Events\\Views\\V2\\Service_Provider' => $baseDir . '/src/Tribe/Events/Views/V2/Service_Provider.php',
    'Tribe\\Tickets\\Migration\\Queue' => $baseDir . '/src/Tribe/Migration/Queue.php',
    'Tribe\\Tickets\\Migration\\Queue_4_12' => $baseDir . '/src/Tribe/Migration/Queue_4_12.php',
    'Tribe\\Tickets\\Promoter\\Service_Provider' => $baseDir . '/src/Tribe/Promoter/Service_Provider.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Builders\\Attendee_Trigger' => $baseDir . '/src/Tribe/Promoter/Triggers/Builders/Attendee_Trigger.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Contracts\\Attendee_Model' => $baseDir . '/src/Tribe/Promoter/Triggers/Contracts/Attendee_Model.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Contracts\\Builder' => $baseDir . '/src/Tribe/Promoter/Triggers/Contracts/Builder.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Contracts\\Triggered' => $baseDir . '/src/Tribe/Promoter/Triggers/Contracts/Triggered.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Director' => $baseDir . '/src/Tribe/Promoter/Triggers/Director.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Dispatcher' => $baseDir . '/src/Tribe/Promoter/Triggers/Dispatcher.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Factory' => $baseDir . '/src/Tribe/Promoter/Triggers/Factory.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Models\\Attendee' => $baseDir . '/src/Tribe/Promoter/Triggers/Models/Attendee.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Observers\\Commerce' => $baseDir . '/src/Tribe/Promoter/Triggers/Observers/Commerce.php',
    'Tribe\\Tickets\\Promoter\\Triggers\\Observers\\RSVP' => $baseDir . '/src/Tribe/Promoter/Triggers/Observers/RSVP.php',
    'Tribe\\Tickets\\Repositories\\Order' => $baseDir . '/src/Tribe/Repositories/Order.php',
    'Tribe\\Tickets\\Repositories\\Order\\Commerce' => $baseDir . '/src/Tribe/Repositories/Order/Commerce.php',
    'Tribe\\Tickets\\Repositories\\Post_Repository' => $baseDir . '/src/Tribe/Repositories/Post_Repository.php',
    'Tribe\\Tickets\\Repositories\\Traits\\Event' => $baseDir . '/src/Tribe/Repositories/Traits/Event.php',
    'Tribe\\Tickets\\Repositories\\Traits\\Post_Attendees' => $baseDir . '/src/Tribe/Repositories/Traits/Post_Attendees.php',
    'Tribe\\Tickets\\Repositories\\Traits\\Post_Tickets' => $baseDir . '/src/Tribe/Repositories/Traits/Post_Tickets.php',
    'Tribe\\Tickets\\Service_Providers\\Customizer' => $baseDir . '/src/Tribe/Service_Providers/Customizer.php',
    'Tribe\\Tickets\\Shortcodes\\Tribe_Tickets_Checkout' => $baseDir . '/src/Tribe/Shortcodes/Tribe_Tickets_Checkout.php',
);
