"use strict";

function readURL(input) {
   if (input.files && input.files[0]) {
      let fileModifiedDate = input.files[0].lastModifiedDate;
      let fileName = input.files[0].name;
      let fileSize = input.files[0].size;
      let fileType = input.files[0].type;
      let element = document.querySelector('.user__create-avatar-wrapper img');
       
      let fileUrl = URL.createObjectURL(input.files[0]);
      element.setAttribute('src', fileUrl);
      element.classList.add('avatar-selected');
   }
}
function getTaskMenu(){
   const menuClass = document.querySelector('#task-form');
if(menuClass){
   menuClass.addEventListener('click', function(e){
     let targetTask = e.target;
     let targetClass = targetTask.className;
     let typeData, url;
     let token = document.querySelector('input[name=_token]').getAttribute('value');
     /* if(targetClass.includes('department-select')){
        url = '/departments/all';
        typeData = 'getDepartmentInfo';
     }else */ if(targetClass.includes('menu-select')){
        typeData = 'getMenuInfo';
        url = '/task/menus';
     }else if(targetClass.includes('task-add-new-initiator')){
        typeData = 'getUserList';
        url = '/departments/all/users';
     }
      
      if(typeData){
        fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
                },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify({
                req: typeData,
            })
        })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            console.log(data);
            const menuWrapper = document.querySelector('#menu-wrapper');
            menuWrapper.classList.toggle('show');

            /* if(typeData === 'getDepartmentInfo'){
                showDepartmentTask(menuWrapper, data);
             }else */ if(typeData === 'getMenuInfo'){
                showMenuTargetTask(menuWrapper, data);
             }else if(typeData === 'getUserList'){
                showDepartmentUserListTask(menuWrapper, data);
             }
             menuWrapper.addEventListener('click', function taskDataEvent(e){
                let target = e.target;
                let child = e.target.childElementCount;
                let offsetChild = target.offsetParent.firstChild;
                
                if(offsetChild.className === 'task-menu-site'){
                    showSubMenu(target, child);
                }
                if(offsetChild.className === 'department-task-list' || offsetChild.className === 'department-user-list'){
                    selectDepartmentTask(target);
                }
                clickActionCloseOpenTask(targetTask,target, this, taskDataEvent);
             });
       })
        .catch(function(error) {
            console.log(error);
        });
      }
    });
    }
}


function showMenuTargetTask(parent,lst) {
    
    parent.insertAdjacentHTML('afterbegin', makeUl(lst));
    closeOpenTaskSelectedComponent(parent.firstChild); 
    addIconToLiWithChild(parent);
    
    function makeUl(list){
        let html = [];
        html.push('<div class="task-menu-site">');                
        html.push('<ul>');
        list.forEach(function(current, index, array) {
            html.push(makeLI(current, index));
        });
        html.push('</ul>');
        html.push('</div>');
        return html.join("\n");
    }
    
                    
    function makeLI(elem, index) {
        let html = [];  
        if (elem.link){
            html.push('<li data-target = "' + elem.link + '">');
        }else{
            html.push('<li>');
        }              
        if (elem.title){
            html.push(elem.title);
        }
        if (elem.children){
            html.push('<div class="sub-menu index-'+index+'">' + makeUl(elem.children) + '</div>');
        }
        html.push('</li>');
        return html.join("\n");
    }
}

function showSubMenu(target, child){
        if(target.tagName === 'LI'){
            let otherLiWithChild = target.closest('ul').querySelectorAll('.active');
            let targetAllSubMenuClass = target.closest('ul').querySelectorAll('.sub-menu');
            if(otherLiWithChild){
                otherLiWithChild.forEach(function(current, index, array){
                    current.classList.remove('active');
                });
                targetAllSubMenuClass.forEach(function(current, index, array){
                    current.classList.remove('show');
                });
            }
            if(child === 0 ){
                target.classList.toggle('active');
                target.classList.toggle('without-child');
            }else{
                target.classList.toggle('active');
                const targetSubMenuClass = target.querySelector('.sub-menu');
                if(targetSubMenuClass){
                    targetSubMenuClass.classList.toggle('show');
                }  
            }
        }
}

/* function showDepartmentTask(parent, data){
    console.log(data);
    let html = [];
    html.push('<div class="department-task-list">');
    html.push('<ul>');
    for(let value in data){
        html.push(`<li>${data[value].dTitle}</li>`);
    }  
    html.push('</ul>');
    html.push('</div');
    html = html.join("\n");
    parent.insertAdjacentHTML('afterbegin', html);
    closeOpenTaskSelectedComponent(parent.firstChild);
    addIconToLiWithChild(parent); 
} */

function showDepartmentUserListTask(parent ,data){
    let html = [];
    html.push('<div class="department-user-list">');
    html.push('<ul>');
    for(let titleDepart in data){
        html.push('<div class="departament-user-column">');
        html.push(`<div class="departament-title-task">${titleDepart}</div>`);
        html.push('<div class="departament-user-body">');
       for(let userDepert in data[titleDepart]){
        html.push(`<li class="departament-list-user-task">${data[titleDepart][userDepert].uName}</li>`);
       }
       html.push('</div>');
       html.push('</div>');
    }
    html.push('</ul>');
    html.push('</div');
    html = html.join("\n");
    parent.insertAdjacentHTML('afterbegin', html);
    closeOpenTaskSelectedComponent(parent.firstChild);
}

function selectDepartmentTask(target){
    if(target.tagName === 'LI'){
        let otherLi = target.closest('ul').querySelector('.active');
        if(otherLi){
            otherLi.classList.remove('active');
        }
        target.classList.toggle('active');   
    }
}
  
function closeOpenTaskSelectedComponent(classInsert){
    const classOpenClose = document.querySelector('.menu-wrapper__close-open');
    if(!classOpenClose){
        const html = `<div class="menu-wrapper__close-open">
        <div class="menu-wrapper__open">Обрати</div>
        <div class="menu-wrapper__close">Закрити</div>
        </div>`;
        classInsert.insertAdjacentHTML('beforeEnd', html); 
    }
    
}

function clickActionCloseOpenTask(firstTarget, target, parent, eventFunc){
    if(target.className === 'menu-wrapper__close'){
        parent.classList.remove('show');
        parent.firstChild.remove();
        parent.removeEventListener('click', eventFunc, false);
    }   
    if(target.className === 'menu-wrapper__open'){
        let selectedData = parent.querySelectorAll('.active');
        let selectedText = [];
        let menuLink;
        if(selectedData){
            selectedData.forEach(function(current, index, array){
                selectedText.push(current.firstChild.textContent);
                menuLink = current.dataset.target;
            });
        }
        selectedText = selectedText.join(" > ");
        if(selectedData[0].className.includes('departament-list-user-task')){
            addFieldWhenSelectUserTask(selectedText);
            deleteAdditionalUserTask();
        }
        firstTarget.value = selectedText;
        if(menuLink){
            let selectorLink = document.querySelector('.task-menu-link');
            if(selectorLink){
                selectorLink.value = menuLink;
            }
        }
        
        parent.classList.remove('show');
        parent.firstChild.remove();
        parent.removeEventListener('click', eventFunc, false);
    }
}

function addFieldWhenSelectUserTask(text){
   let inputAfter = document.querySelector('.task-form__initiator input');
   let html =`<div class="task-additional-user-wrapper"><span class="task-close-icon-user">&#8722</span><input class="task-input-text task-form__initiator-name" value="${text}" type="text" name="taskInitiatorAdditional[]" required="" autocomplete="off" readonly=""></div>`;
   inputAfter.insertAdjacentHTML('afterEnd', html); 
}

function deleteAdditionalUserTask(){
   let closeIconUser = document.querySelector('.task-additional-user-wrapper .task-close-icon-user');
   if(closeIconUser){
        closeIconUser.addEventListener('click', function clickDeleteUserIcon(){
            console.log( this.closest('.task-additional-user-wrapper'));
            this.closest('.task-additional-user-wrapper').remove();
        });
   }
}

function addIconToLiWithChild(parent){
    let allLiTask = parent.querySelectorAll('li');
    allLiTask.forEach(function(current, index, array){
        if(current.childElementCount > 0){
            current.classList.add('task-have-children');
        }
    });
}

function taskFileUploadController(){
    const fileInput = document.querySelector('#taskFiles');
    let progressBar = document.querySelector('#task-load-file-progress');
    const fileIconUpload = document.querySelector('.task-upload-file-wrapper #task-load-file-icons');
    let formClass = document.querySelector('#formCreateTask');
    let buttonSendForm = document.querySelector('.task-create-send-button');
    let uploadProgress;
    let allSizeFiles = [];

    if(fileInput){
    fileInput.addEventListener('change', function (e) {
         e.preventDefault();
         let files = fileInput.files;
         if (!files) return;
         handleFiles(files);
      });
    }
      function handleFiles(files) {
        files = [...files];
        checkCountFile(files);
        initializeProgress(files.length);
        files.forEach(uploadFile);
        console.log(allSizeFiles);
        files.forEach(createFileUploadIcon);
        resetFileUpload();
      }

      function formCancelSend(fileProcess){
        function removeSubmit(e){
            e.preventDefault();
        };
          if(fileProcess !== 100){
            buttonSendForm.classList.add('disabled');
            formClass.addEventListener('submit', () => {removeSubmit(e);});
          }else{
            buttonSendForm.classList.remove('disabled');
            formClass.removeEventListener('submit', removeSubmit, false);
          }
      }

      function uploadFile(file, i) {
        const url = '/task/files/upload';
        let token = document.forms.taskForm.elements._token.getAttribute('value');
        let xhr = new XMLHttpRequest()
        let formData = new FormData()
        formData.append('file', file);

        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json, text-plain, */*");
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        xhr.withCredentials = true;
        xhr.responseType = 'json';
        xhr.upload.addEventListener("progress", function(e) {
            updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
        });
        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let responseObj = xhr.response;
                console.log(responseObj);
            }
            else if (xhr.readyState == 4 && xhr.status != 200) {
                console.log('error');
            }
          });
        xhr.send(formData);
      }

      function createFileUploadIcon(file, i) {
        const titleUploadFileForm = document.querySelector('.task-upload-file-wrapper .task-title');
        const parentWrapper = document.querySelector('.task-upload-file-wrapper #task-load-file-icons');
        let filename = file.name;
        let filesize = file.size;
        let filetype = file.type;
        let filetypeExtension = filename.split('.').pop();
        let filenameWithoutExtension = filename.replace(filetypeExtension, "");;
        let fileLastModified = file.lastModified;
        let fileUrl = URL.createObjectURL(file);

        let fileTypeIcon = [
            {extension: 'doc'},
            {extension: 'docx'},
            {extension: 'rtf'},
            {extension: 'zip'},
            {extension: 'rar'},
            {extension: 'txt'},
            {extension: 'pdf'},
            {extension: 'xls'},
            {extension: 'xlsx'},
            {extension: 'jpg'},
            {extension: 'png'},
        ];
        

        fileTypeIcon.forEach(function(current, index, array){
            if(current.extension === filetypeExtension){
                let html = `<div class="task-upload-icon"><img src="/images/icons/typeFile/${current.extension + '.svg'}" alt="${filetypeExtension}">
                <span class="task-upload-filename">` + filenameWithoutExtension.substr(0, 20)  + `..</span>
                </div>`;
                if(parentWrapper){
                    parentWrapper.insertAdjacentHTML('beforeEnd', html);
                }
            }
        });
        checkFilesize(i, filesize);
      }

      function checkFilesize(filenumber, filesize){
        allSizeFiles[filenumber] = allSizeFiles[filenumber-1] + filesize;
      }

      function resetFileUpload(){
          const resetButton = document.querySelector('#task-upload-reset-file');
          resetButton.classList.add('show');
          resetButton.addEventListener('click', function clickResetButton(e){
            fileInput.value = "";
            progressBar.value = 0;
            fileIconUpload.innerHTML = "";
            this.classList.remove('show');
          });
      }

      function checkCountFile(files){
        let count = files.length;
        let maxCountFiles = 50;
        if(count > maxCountFiles){
            alert(`Перевищено допустиму кількість завантажуваних файлів (${maxCountFiles})`);
            throw new Error(`Перевищено допустиму кількість завантажуваних файлів (${maxCountFiles})`);
        }
      }

      function initializeProgress(numFiles) {
        progressBar.value = 0;
        uploadProgress = [];
        for(let i = numFiles; i > 0; i--) {
          uploadProgress.push(0);
        }
      }
      
      function updateProgress(fileNumber, percent) {
       uploadProgress[fileNumber] = percent;
        let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length;
        formCancelSend(total);
        progressBar.value = total;
      }
}

function displayWindowSize(){
    let w = document.documentElement.clientWidth;
    let h = document.documentElement.clientHeight;
    
    resizeProcessBarTaskUpload();
}

function resizeProcessBarTaskUpload(){
    let fieldUploadTaskFile = document.querySelector('#taskFiles');
    let processBarUploadTaskFile = document.querySelector('#task-load-file-progress');
    if(fieldUploadTaskFile){
        let fieldUploadTaskFileWidth  = fieldUploadTaskFile.offsetWidth + 38;
        let fieldUploadTaskFileHeight  = fieldUploadTaskFile.offsetHeight;
        
        processBarUploadTaskFile.style.width = fieldUploadTaskFileHeight + 'px';
        processBarUploadTaskFile.style.height = fieldUploadTaskFileWidth + 'px';
    }
}

function changeTaskTablePage(){
   let taskTitle = document.querySelector('.task-group-title-wrapper');
   if(taskTitle){
       let taskTitleActive = taskTitle.querySelector('.task-title');
       taskTitleActive.classList.add('active');
       let taskShowTable = document.querySelector('#'+ taskTitleActive.dataset.table).closest('.tasks__table');
        taskShowTable.classList.add('active');

        taskTitle.addEventListener('click', function(e){
        if(e.target.tagName === 'SPAN'){
            for(var i=0; i<this.children.length; i++){
                this.children[i].classList.remove('active');
            }
            e.target.classList.add('active');
            
            let allTaskTable = document.querySelectorAll('.tasks__wrapper .tasks__table');
            for(var i=0; i<allTaskTable.length; i++){
                allTaskTable[i].classList.remove('active');
            }
            taskShowTable = document.querySelector('#'+ e.target.dataset.table).closest('.tasks__table');
            taskShowTable.classList.add('active');
        }
      });
   }
}


function uploadZipFilesTask(){
    let uploadButton = document.querySelector('.task-file-active-bar__download');
    if(!uploadButton){
        return void 0;
    }
    uploadButton.addEventListener('click', function(){
        let token = document.querySelector('input[name=_token]').getAttribute('value');
        let task = document.querySelector('#task-number').dataset.number;
        let url = '/tasks/download';
        fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
                },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify({
                req: 'getZipFiles',
                task
            })
        })
        .then((response) => {
            return response.text();
        })
        .then((data) => {
            console.log(data);
            if(data){
                let downloadLink = document.querySelector('.insert_download_link');
                downloadLink.setAttribute('href', data);
                downloadLink.click();
            }
        });
    });
}


function passwordGenerateAction(){
    let buttonGenerate = document.querySelector('.user__create-password--random');
    if(buttonGenerate){
        buttonGenerate.addEventListener('click', function () {
            let password = generatePassword(12)
            this.previousSibling.previousSibling.value =  password;
            this.nextSibling.remove();
            console.log(password);
            this.insertAdjacentHTML('afterEnd', `<div class="user-generated-pass">${password}</div>`);
        });
    }
}

function generatePassword(length) {
       let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}


document.addEventListener('DOMContentLoaded', (e) => {
   let avatar = document.querySelector('#user__create-avatar');
   if(avatar){
      avatar.addEventListener('change', function () {
         readURL(this);
     });
   }
    window.addEventListener("resize", displayWindowSize);
    resizeProcessBarTaskUpload();
    getTaskMenu();
    taskFileUploadController();
    changeTaskTablePage();
    uploadZipFilesTask();
    passwordGenerateAction();
});//document.ready