
const list = document.getElementById("list");
const list_btn = document.getElementById("list-btn");
const calendar = document.getElementById("calendar");
const calendar_btn = document.getElementById("calendar-btn");
const addTasks = document.getElementById("addTasks");
const addTasks_btn = document.getElementById("addTasks-btn");
const title=document.querySelector("title");
const menu=document.getElementById("menu");
const achieved=document.getElementById("achieved");
const achieved_btn=document.getElementById("achieved-btn");
const updateTasks=document.getElementById("updateTasks");

document.addEventListener("DOMContentLoaded", function () {
  clearArea();
  fetchCalendar();
});

list_btn.addEventListener("click", function () {
  fetchList();
});

achieved_btn.addEventListener("click",function(){
  fetchAchieved();
});

calendar_btn.addEventListener("click", function () {
  fetchCalendar();
});

addTasks_btn.addEventListener("click", function () {
  fetchAddTasks();
});

menu.addEventListener("click",function(){
  hamburgerMenu();
});

function clearArea() {
  list.innerHTML = "";
  achieved.innerHTML="";
  calendar.innerHTML = "";
  addTasks.innerHTML = "";
  updateTasks.innerHTML="";
}

function fetchList() {
  title.innerHTML="タスク一覧";
  clearArea();
  fetch("list.php")
    .then((response) => response.text())
    .then((data) => {
      list.innerHTML = data;
      updateTask();
    })
    .catch((error) => console.error("Error:", error));
}

function fetchAchieved() {
  title.innerHTML="タスク完了一覧";
  clearArea();
  fetch("achieved.php")
    .then((response) => response.text())
    .then((data) => (list.innerHTML = data))
    .catch((error) => console.error("Error:", error));
}

function fetchCalendar() {
  title.innerHTML="カレンダー";
  clearArea();
  fetch("calendar.php")
    .then((response) => response.text())
    .then((data) => {
      calendar.innerHTML = data;
      changeMonthOfCalendar();
    })
    .catch((error) => console.error("Error:", error));
}

function changeMonthOfCalendar(){
  const month_btn= document.querySelectorAll(".month-btn");
  month_btn.forEach(el =>{
    const year=el.getAttribute("year");
    const month=el.getAttribute("month");
    el.addEventListener("click",function(){
      fetch('calendar.php?year='+year+'&month='+month)
      .then((response) => response.text())
      .then((data) => {
        calendar.innerHTML = data;
        changeMonthOfCalendar();
      })
      .catch((error) => console.error("Error:", error));
    });
  });
  const event_day=document.querySelectorAll(".event-day");
  const year=document.getElementById("current-state").getAttribute("current-year");
  const month=document.getElementById("current-state").getAttribute("current-month");
  event_day.forEach(el=>{
    el.addEventListener('click',function(){
      fetch('/COFFEE/controller/task_data.php?year='+year+'&month='+month+'&day='+el.innerHTML)
        .then(response=>response.json())
        .then(data=>{
          const taskBox = document.getElementById('task-box');
          if(taskBox.classList.contains('hidden')){
            taskBox.classList.toggle('hidden');
          }
          const ul = taskBox.querySelector('ul');
          ul.innerHTML="";
          data.forEach(idx=>{
            ul.appendChild(displayTasks(idx));
            updateTask();
          });
        })
        .catch(error=>console.error('Error',error));
    });
  });
}

function displayTasks(idx){
  const li=document.createElement("li");
  li.innerHTML=`
    <li><strong>${idx.item_title}</strong></li>
    <dl>
      <dt>詳細</dt>
      <dd>${idx.item_detail}</dd>
      <dt>開始日</dt>
      <dd>${idx.item_start_date}</dd>
      <dt>終了日</dt>
      <dd>${idx.item_end_date}</dd>
      <dt>操作</dt>
      <dd>
        <button class="update-btn" update-id="${idx.item_id}">編集</button>
        <button type="submit" id="update_task" onclick="location.href='../controller/completed_task.php?id=${idx.item_id}'">完了</button>
        <button type="submit" id="delete_task" onclick="location.href='../controller/delete_task.php?id=${idx.item_id}'">削除</button>
      </dd>
    </dl>
  `;
  return li;
}

function fetchAddTasks() {
  title.innerHTML="タスク追加";
  clearArea();
  fetch("addTasks.php")
    .then((response) => response.text())
    .then((data) => (addTasks.innerHTML = data))
    .catch((error) => console.error("Error:", error));
}

function hamburgerMenu(){
  const hamburger=document.getElementById("hamburger");
  hamburger.classList.toggle("hidden");
  list.classList.toggle("hidden");
  calendar.classList.toggle("hidden");
  addTasks.classList.toggle("hidden");
  //ログアウト
  const logout = document.getElementById('logout');
  logout.addEventListener("click",function(event){
      if (!confirm("ログアウトしますか？")) {
          event.preventDefault();
      }
  });
}

function updateTask(){
  const update_btn=document.querySelectorAll(".update-btn");
  update_btn.forEach(btn=>{
    const update_id=btn.getAttribute("update-id");
    btn.addEventListener("click",function(){
      clearArea();
      fetch("updateTasks.php?id="+update_id)
        .then(response=>response.text())
        .then(data=>updateTasks.innerHTML=data)
        .catch((error)=>console.error("Error:"+error));
    });
  });
}
