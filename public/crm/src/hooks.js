// module for all third party dependencies

var $ = require('jquery');

var DataTable = require( 'datatables.net' )();
var DataTableBs = require( 'datatables.net-bs' )();
var DataTableRes = require( 'datatables.net-responsive-bs' )();
var Moment = require('moment');
var Datepicker = require('eonasdan-bootstrap-datetimepicker');
import {bus} from './util/eventBus.js';
export {
    $,
    DataTable,
    DataTableBs,
    DataTableRes,
    Moment,
    bus,
    Datepicker
}
