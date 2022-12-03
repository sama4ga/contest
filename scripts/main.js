"use strict";

var errors = [];

/**
 * @summary Function to validate form and its elements
 * @param {HTMLFormElement} form The form to be validated
 * @returns Boolean: True if form is valid and false if there are errors
 */
function validate(form) {
  // user does not want to validate the form. Honour this and submit
  if(form.formNoValidate)return true;
  form.forEach((element)=>{
    //if(element.formNoValidate)continue;
    valCtl(element);
    switch (element.type) {
      case "select-one":
        valSelectOne(element);
        break;
      case "select-multiple":
        valSelectMultiple(element);
        break;
      case "email":
        valEmail(element);
        break;
      case "text":
        valText(element);
        break;
      case "number":
        valNumber(element);
        break;
      case "datetime":
        valDateTime(element);
        break;
      case "datetime-local":
        valDateTimeLocal(element);
        break;
      case "time":
        valTime(element);
        break;
      case "date":
        valDate(element);
        break;
      case "range":
        valRange(element);
        break;
      case "password":
        valPassword(element);
        break;
      case "textarea":
        valTextArea(element);
        break;
      case "tel":
        valTel(element);
        break;
      case "checkbox":
        valCheckbox(element);
        break;
      case "radio":
        valRadio(element);
        break;
      default:
        break;
    }
  });

  return errors.length > 0 ? false : true;
  //trailing whitespace
  //^[ \t]+|[ \t]+$
}
/**
 * 
 * @param {*} ctl control to be validated
 * @summary Function to perform common checks on all controls
 */
function valCtl(ctl) {
  //check for required values
  if (ctl.required && (ctl.value.trim() == "" || ctl.value == undefined || ctl.value == null)) {
    errors.push(ctl.name + " is required");ctl.validationMessage = "Supply a value here to proceed";
  }
  
}
function valSelectOne(ctl) {
  //return ctl.value=="default"?false:true;
  ctl.value=="default"?errors.push("Select an option in " + ctl.name + " to proceed"):"";
}
function valSelectMultiple(ctl) {
  
}
function valPassword(ctl) {
  
}
function valEmail(ctl) {
  ctl.value.match(/[\w._%+-]+@[\.-]+\.[a-zA-Z]{2,4}/);
}
function valText(ctl) {
  
}
function valTel(ctl) {
  
}
function valTextArea(ctl) {
  
}
function valTime(ctl) {
  
}
function valDate(ctl) {
  
}
function valDateTime(ctl) {
  
}
function valDateTimeLocal(ctl) {
  
}
function valRadio(ctl) {
  
}
function valCheckbox(ctl) {
  
}
function valRange(ctl) {
  
}
function valNumber(ctl) {
  ctl.value.match(/[+-]?(\d+(\.\d+)?|\.\d+)([eE][+-]?\d+)/);
}

function printList(listId) {
  // const list = document.getElementById(listId);
  // list.style.color = "black";
  // list.style.backgroundColor = "white";
  window.print();
}

function confirmAction(action,item,url="") {
  var ans = confirm("Are you sure you want to " + action + " " + item + "?");
  if (ans) {
    return true;
  }
  return false;
}