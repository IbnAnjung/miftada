/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

const csrf_token = $('meta[name="csrf_token"]').attr('content');

function showModal(dom){

    $(dom).modal('show')

}