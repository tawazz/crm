// module for all third party dependencies

import $ from 'jquery'

var DataTable = require( 'datatables.net' )();
var DataTableBs = require( 'datatables.net-bs' )();
var DataTableRes = require( 'datatables.net-responsive-bs' )();
var Moment = require('moment');
import base_path from './config'
export {
    $,
    DataTable,
    DataTableBs,
    DataTableRes,
    Moment,
    base_path
}
