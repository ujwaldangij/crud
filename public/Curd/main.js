import { general_function } from "./general_function.js";

$(document).ready(function () {
    general_function.table_heading_maker(['Id','Name','Email','Created at','Updated at','Action'])
    general_function.show_table();
    general_function.add_records();
    general_function.fill_edit_records_form();
    general_function.delete_record();
});
