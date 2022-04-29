<?php

namespace Inc\Base;

class Roles
{
    function addRoles()
    {
        // TODO: add capabilities of buddyboss roles
        $subsCapabilities = get_role('subscriber')->capabilities;

        if (get_role('investor') === null) {
            add_role('investor', 'Investor', $subsCapabilities);
        }

        if (get_role('startup') === null) {
            add_role('startup', 'Startup', $subsCapabilities);
        }

        if (get_role('buyer') === null) {
            add_role('buyer', 'Buyer', $subsCapabilities);
        }

        if (get_role('supplier') === null) {
            add_role('supplier', 'Supplier', $subsCapabilities);
        }
    }
}
