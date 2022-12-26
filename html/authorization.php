<?php

include_once dirname(__FILE__) . '/' . 'components/application.php';
include_once dirname(__FILE__) . '/' . 'components/page/page.php';
include_once dirname(__FILE__) . '/' . 'components/security/permission_set.php';
include_once dirname(__FILE__) . '/' . 'components/security/user_authentication/hard_coded_user_authentication.php';
include_once dirname(__FILE__) . '/' . 'components/security/grant_manager/hard_coded_user_grant_manager.php';
include_once dirname(__FILE__) . '/' . 'components/security/recaptcha.php';
include_once dirname(__FILE__) . '/' . 'components/security/user_identity_storage/user_identity_session_storage.php';

$users = array('user' => 'user',
    'admin' => 'admin',
    'administrator' => 'administrator');

$grants = array('guest' => 
        array()
    ,
    'defaultUser' => 
        array('public.aircrafts' => new PermissionSet(false, false, false, false),
        'public.aircrafts.public.schedules' => new PermissionSet(false, false, false, false),
        'public.airports' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes01' => new PermissionSet(false, false, false, false),
        'public.amenities' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.cabintypes' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.tickets' => new PermissionSet(false, false, false, false),
        'public.countries' => new PermissionSet(false, false, false, false),
        'public.countries.public.airports' => new PermissionSet(false, false, false, false),
        'public.countries.public.offices' => new PermissionSet(false, false, false, false),
        'public.countries.public.tickets' => new PermissionSet(false, false, false, false),
        'public.offices' => new PermissionSet(false, false, false, false),
        'public.offices.public.users' => new PermissionSet(false, false, false, false),
        'public.roles' => new PermissionSet(false, false, false, false),
        'public.roles.public.users' => new PermissionSet(false, false, false, false),
        'public.routes' => new PermissionSet(false, false, false, false),
        'public.routes.public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules.public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.users' => new PermissionSet(false, false, false, false),
        'public.users.public.tickets' => new PermissionSet(false, false, false, false),
        'public.aircrafts_schedules' => new PermissionSet(false, false, false, false))
    ,
    'guest' => 
        array('public.aircrafts' => new PermissionSet(false, false, false, false),
        'public.aircrafts.public.schedules' => new PermissionSet(false, false, false, false),
        'public.airports' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes01' => new PermissionSet(false, false, false, false),
        'public.amenities' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.cabintypes' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.tickets' => new PermissionSet(false, false, false, false),
        'public.countries' => new PermissionSet(false, false, false, false),
        'public.countries.public.airports' => new PermissionSet(false, false, false, false),
        'public.countries.public.offices' => new PermissionSet(false, false, false, false),
        'public.countries.public.tickets' => new PermissionSet(false, false, false, false),
        'public.offices' => new PermissionSet(false, false, false, false),
        'public.offices.public.users' => new PermissionSet(false, false, false, false),
        'public.roles' => new PermissionSet(false, false, false, false),
        'public.roles.public.users' => new PermissionSet(false, false, false, false),
        'public.routes' => new PermissionSet(false, false, false, false),
        'public.routes.public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules.public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.users' => new PermissionSet(false, false, false, false),
        'public.users.public.tickets' => new PermissionSet(false, false, false, false),
        'public.aircrafts_schedules' => new PermissionSet(false, false, false, false))
    ,
    'user' => 
        array('public.aircrafts' => new PermissionSet(false, false, false, false),
        'public.aircrafts.public.schedules' => new PermissionSet(false, false, false, false),
        'public.airports' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes01' => new PermissionSet(false, false, false, false),
        'public.amenities' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.cabintypes' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.tickets' => new PermissionSet(false, false, false, false),
        'public.countries' => new PermissionSet(false, false, false, false),
        'public.countries.public.airports' => new PermissionSet(false, false, false, false),
        'public.countries.public.offices' => new PermissionSet(false, false, false, false),
        'public.countries.public.tickets' => new PermissionSet(false, false, false, false),
        'public.offices' => new PermissionSet(false, false, false, false),
        'public.offices.public.users' => new PermissionSet(false, false, false, false),
        'public.roles' => new PermissionSet(false, false, false, false),
        'public.roles.public.users' => new PermissionSet(false, false, false, false),
        'public.routes' => new PermissionSet(false, false, false, false),
        'public.routes.public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules.public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.users' => new PermissionSet(false, false, false, false),
        'public.users.public.tickets' => new PermissionSet(false, false, false, false),
        'public.aircrafts_schedules' => new PermissionSet(false, false, false, false))
    ,
    'admin' => 
        array('public.aircrafts' => new PermissionSet(false, false, false, false),
        'public.aircrafts.public.schedules' => new PermissionSet(false, false, false, false),
        'public.airports' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes01' => new PermissionSet(false, false, false, false),
        'public.amenities' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.cabintypes' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.tickets' => new PermissionSet(false, false, false, false),
        'public.countries' => new PermissionSet(false, false, false, false),
        'public.countries.public.airports' => new PermissionSet(false, false, false, false),
        'public.countries.public.offices' => new PermissionSet(false, false, false, false),
        'public.countries.public.tickets' => new PermissionSet(false, false, false, false),
        'public.offices' => new PermissionSet(false, false, false, false),
        'public.offices.public.users' => new PermissionSet(false, false, false, false),
        'public.roles' => new PermissionSet(false, false, false, false),
        'public.roles.public.users' => new PermissionSet(false, false, false, false),
        'public.routes' => new PermissionSet(false, false, false, false),
        'public.routes.public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules.public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.users' => new PermissionSet(false, false, false, false),
        'public.users.public.tickets' => new PermissionSet(false, false, false, false),
        'public.aircrafts_schedules' => new PermissionSet(false, false, false, false))
    ,
    'administrator' => 
        array('public.aircrafts' => new PermissionSet(false, false, false, false),
        'public.aircrafts.public.schedules' => new PermissionSet(false, false, false, false),
        'public.airports' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes' => new PermissionSet(false, false, false, false),
        'public.airports.public.routes01' => new PermissionSet(false, false, false, false),
        'public.amenities' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenities.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.cabintypes' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.amenitiescabintype' => new PermissionSet(false, false, false, false),
        'public.cabintypes.public.tickets' => new PermissionSet(false, false, false, false),
        'public.countries' => new PermissionSet(false, false, false, false),
        'public.countries.public.airports' => new PermissionSet(false, false, false, false),
        'public.countries.public.offices' => new PermissionSet(false, false, false, false),
        'public.countries.public.tickets' => new PermissionSet(false, false, false, false),
        'public.offices' => new PermissionSet(false, false, false, false),
        'public.offices.public.users' => new PermissionSet(false, false, false, false),
        'public.roles' => new PermissionSet(false, false, false, false),
        'public.roles.public.users' => new PermissionSet(false, false, false, false),
        'public.routes' => new PermissionSet(false, false, false, false),
        'public.routes.public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules' => new PermissionSet(false, false, false, false),
        'public.schedules.public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets' => new PermissionSet(false, false, false, false),
        'public.tickets.public.amenitiestickets' => new PermissionSet(false, false, false, false),
        'public.users' => new PermissionSet(false, false, false, false),
        'public.users.public.tickets' => new PermissionSet(false, false, false, false),
        'public.aircrafts_schedules' => new PermissionSet(false, false, false, false))
    );

$appGrants = array('guest' => new PermissionSet(false, false, false, false),
    'defaultUser' => new PermissionSet(true, false, false, false),
    'guest' => new PermissionSet(false, false, false, false),
    'user' => new PermissionSet(true, true, false, false),
    'admin' => new AdminPermissionSet(),
    'administrator' => new AdminPermissionSet());

$dataSourceRecordPermissions = array();

$tableCaptions = array('public.aircrafts' => 'Aircrafts',
'public.aircrafts.public.schedules' => 'Aircrafts->Schedules',
'public.airports' => 'Airports',
'public.airports.public.routes' => 'Airports->Routes',
'public.airports.public.routes01' => 'Airports->Routes',
'public.amenities' => 'Amenities',
'public.amenities.public.amenitiescabintype' => 'Amenities->Amenitiescabintype',
'public.amenities.public.amenitiestickets' => 'Amenities->Amenitiestickets',
'public.amenitiescabintype' => 'Amenitiescabintype',
'public.amenitiestickets' => 'Amenitiestickets',
'public.cabintypes' => 'Cabintypes',
'public.cabintypes.public.amenitiescabintype' => 'Cabintypes->Amenitiescabintype',
'public.cabintypes.public.tickets' => 'Cabintypes->Tickets',
'public.countries' => 'Countries',
'public.countries.public.airports' => 'Countries->Airports',
'public.countries.public.offices' => 'Countries->Offices',
'public.countries.public.tickets' => 'Countries->Tickets',
'public.offices' => 'Offices',
'public.offices.public.users' => 'Offices->Users',
'public.roles' => 'Roles',
'public.roles.public.users' => 'Roles->Users',
'public.routes' => 'Routes',
'public.routes.public.schedules' => 'Routes->Schedules',
'public.schedules' => 'Schedules',
'public.schedules.public.tickets' => 'Schedules->Tickets',
'public.tickets' => 'Tickets',
'public.tickets.public.amenitiestickets' => 'Tickets->Amenitiestickets',
'public.users' => 'Users',
'public.users.public.tickets' => 'Users->Tickets',
'public.aircrafts_schedules' => 'Aircrafts Schedules');

function GetReCaptcha($formId) {
    return null;
}

function SetUpUserAuthorization()
{
    global $users;
    global $grants;
    global $appGrants;
    global $dataSourceRecordPermissions;

    $hasher = GetHasher('');
    $userAuthentication = new HardCodedUserAuthentication(new UserIdentitySessionStorage(), false, $hasher, $users);
    $grantManager = new HardCodedUserGrantManager($grants, $appGrants);

    GetApplication()->SetUserAuthentication($userAuthentication);
    GetApplication()->SetUserGrantManager($grantManager);
    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}
