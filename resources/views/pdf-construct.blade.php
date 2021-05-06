<div class="pdf-view-wrapper">
   <div class="pdf-view-head">
      <p class="pdf-view-text bold">Погоджено</p>
      <p class="pdf-view-text chief-department">{{$classObj->getDepartmentName($task->tAcceptChief)}}</p>
      <p class="pdf-view-text chief-name">{{$classObj->getUserName($task->tAcceptChief)}}</p>
      <div class="pdf-view-text chief-accept-time">{{$task->tChiefAcceptTime}}</div>
   </div>
   <div class="pdf-view-body-title">
      <p class="pdf-view-body-text pdf-view-number bold">Замовлення № <span>{{$task->tNumber}}</span></p>
      <p class="pdf-view-body-text bold">на розміщення інформаційних матеріалів та документів</p>
      <p class="pdf-view-body-text bold">на офіційному Веб-сайті обласної ради</p>
   </div>
   <div class="pdf-view-body-info">
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">1. Структурний підрозділ, посадова особа, яка ініціює розміщення інформаційних матеріалів, документів</div>
         <div class="pdf-view-body-info-text dynamic bold">{{$classObj->getDepartmentName($task->tInitiator)}}</div>
      </div>
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">2. Розділ, підрозділ меню</div>
         <div class="pdf-view-body-info-text dynamic bold">{{$task->tSitePath}}</div>
      </div>
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">3. Назва матеріалу</div>
         <div class="pdf-view-body-info-text dynamic bold">{{$task->tSignName}}</div>
      </div>
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">4. Кількість сторінок:
            <span class="pdf-view-body-info-text dynamic bold">{{$task->tPage}}</span>
         </div>
      </div>
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">5. Запланована дата розміщення матеріалу:
            <span class="pdf-view-body-info-text dynamic bold">{{$task->tCreateTime}}</span>
         </div>
      </div>
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">Відповідальний за своєчасне надання інформації для розміщення на сайті</div>
         <div>
            <div class="pdf-view-body-info-text dynamic bold">{{$classObj->getUserName($task->tInitiator)}}</div>
            @if(isset($task->tInitiatorAdditional))
            <div class="pdf-view-body-info-text dynamic bold">{{$classObj->getUserName($task->tInitiatorAdditional)}}</div>
            @endif
         </div>
      </div>
   </div>

   <div class="pdf-view-body-info-executor">
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">1. Замовлення прийнято до виконання:
            <span class="pdf-view-body-info-text dynamic bold">{{$task->tExecutorGetDate}}</span>
         </div>
      </div>
      <div class="pdf-view-body-info-block">
         <div class="pdf-view-body-info-text">Посадова особа Виконавця
            <div class="dynamic">
               <span class="pdf-view-body-info-text dynamic bold">{{$classObj->getUserName($task->tExecutor)}}</span>
               <span class="pdf-view-body-info-text dynamic">({{$classObj->getDepartmentName($task->tExecutor)}})</span>
            </div>
         </div>
      </div>
      <div>
         <div class="pdf-view-body-info-text">2. Замовлення виконано:
            <span class="pdf-view-body-info-text dynamic bold">{{$task->tCloseTime}}</span>
         </div>
      </div>
      <div>
         <div class="pdf-view-body-info-text">Посадова особа Виконавця</div>
         <div class="dynamic">
            <span class="pdf-view-body-info-text dynamic bold">{{$classObj->getUserName($task->tExecutor)}}</span>
            <span class="pdf-view-body-info-text dynamic">({{$classObj->getDepartmentName($task->tExecutor)}})</span>
         </div>
      </div>
   </div>
</div>