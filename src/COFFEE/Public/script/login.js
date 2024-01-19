
const name_box=document.getElementById("name-box");
const login_btn=document.getElementById("login-btn");
const register_btn=document.getElementById("register-btn");
const form_box=document.getElementById("form");
let login_flag;
let regi_flag;
const welcome=[
  "ようこそ","はじめまして"
];
const words=[
  "ログイン",
  "新規登録",
];
const ID_STR="ID";
const DISP_STR="画面"

console.log(document.querySelectorAll("form"));

document.addEventListener("DOMContentLoaded",function(){
  login_btn.innerHTML=words[0];
  register_btn.innerHTML=words[1];
  name_box.classList.toggle("hidden");
  document.querySelector("h1").innerHTML=welcome[0];
  document.querySelector("title").innerHTML=words[0]+DISP_STR;
  document.getElementById("id_str").innerHTML=words[0]+ID_STR;
  document.querySelector("input[type='submit']").value=words[0];
  document.querySelector("form").action="../controller/check_login.php";
  login_btn.classList.toggle("login-box");
  form_box.classList.toggle("login-box");
  login_flag=true;
  regi_flag=false;
});

login_btn.addEventListener("click",function(){
  if(!login_flag){
    name_box.classList.toggle("hidden");
    login_btn.classList.toggle("login-box");
    register_btn.classList.toggle("register-box");
    form_box.classList.toggle("login-box");
    form_box.classList.toggle("register-box");
    document.querySelector("h1").innerHTML=welcome[0];
    document.querySelector("title").innerHTML=words[0]+DISP_STR;
    document.getElementById("id_str").innerHTML=words[0]+ID_STR;
    document.querySelector("input[type='submit']").value=words[0];
    document.querySelector("form").action="../controller/check_login.php";
    login_flag=!login_flag;
    regi_flag=!regi_flag;
  }
});

register_btn.addEventListener("click",function(){
  if(!regi_flag){
    name_box.classList.toggle("hidden");
    document.querySelector("h1").innerHTML=welcome[1];
    document.querySelector("title").innerHTML=words[1]+DISP_STR;
    document.getElementById("id_str").innerHTML=words[1]+ID_STR;
    document.querySelector("input[type='submit']").value=words[1];
    document.querySelector("form").action="../controller/register_login.php";
    login_btn.classList.toggle("login-box");
    register_btn.classList.toggle("register-box");
    form_box.classList.toggle("login-box");
    form_box.classList.toggle("register-box");
    login_flag=!login_flag;
    regi_flag=!regi_flag;
  }
});


