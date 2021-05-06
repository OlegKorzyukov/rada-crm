<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="robots" content="noindex, nofollow">
   <title>Oblrada CRM</title>

   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">

   <link rel="stylesheet" type="text/css" href="{{ asset('/css/jstable.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('/css/reset.css') }}">
</head>

<body>
   <div class="body_wrapper">
      <aside>
         @include('sidebar')
      </aside>
      <section class="s-1">
         @include('header')
         @yield ('content')
      </section>
   </div>

   <script src="{{ asset('/js/jsTable/jstable.min.js') }}"></script>
   <script>
      let myTableUser = new JSTable("#user-table", {
         sortable: true,
         searchable: true,
         perPage: 25,
         perPageSelect: [1, 25, 50, 100],
         labels: {
            placeholder: "Пошук...",
            perPage: "{select} записів на сторінці",
            noRows: "Не знайдено записів",
            info: "{end} з {rows} записів",
            loading: "Завантаження...",
            infoFiltered: "{info} {end} з {rows} записів (відфільтровано {rowsTotal} записів)"
         },
         /*columns: [{
               select: 0,
               sortable: true,
               sort: "asc",
               searchable: true,
               render: function(cell, idx) {
                  let data = cell.innerHTML;
                  return data;
               }
            },
            {
               select: [1, 2],
               sortable: false,
               searchable: false,
               render: function(cell, idx) {
                  let data = cell.innerHTML;
                  let link = cell.dataset.link;
                  return '<a href="' + link + '">' + data + '</a>';
               }
            }
         ]*/
      });
      let myTableGroup = new JSTable("#group-table", {
         sortable: true,
         searchable: true,
         perPage: 25,
         perPageSelect: [25, 50, 100],
         labels: {
            placeholder: "Пошук...",
            perPage: "{select} записів на сторінці",
            noRows: "Не знайдено записів",
            info: "{end} з {rows} записів",
            loading: "Завантаження...",
            infoFiltered: "{info} {end} з {rows} записів (відфільтровано {rowsTotal} записів)"
         },
      });
      let myTableTaskActual = new JSTable("#task-table-actual", {
         sortable: true,
         searchable: true,
         perPage: 25,
         perPageSelect: [25, 50, 100],
         labels: {
            placeholder: "Пошук...",
            perPage: "{select} записів на сторінці",
            noRows: "Не знайдено записів",
            info: "{end} з {rows} записів",
            loading: "Завантаження...",
            infoFiltered: "{info} {end} з {rows} записів (відфільтровано {rowsTotal} записів)"
         },
      });
      let myTableTaskHistory = new JSTable("#task-table-history", {
         sortable: true,
         searchable: true,
         perPage: 25,
         perPageSelect: [25, 50, 100],
         labels: {
            placeholder: "Пошук...",
            perPage: "{select} записів на сторінці",
            noRows: "Не знайдено записів",
            info: "{end} з {rows} записів",
            loading: "Завантаження...",
            infoFiltered: "{info} {end} з {rows} записів (відфільтровано {rowsTotal} записів)"
         },
      });
      let myTableTaskAcceptQueue = new JSTable("#task-table-accept-queue", {
         sortable: true,
         searchable: true,
         perPage: 25,
         perPageSelect: [25, 50, 100],
         labels: {
            placeholder: "Пошук...",
            perPage: "{select} записів на сторінці",
            noRows: "Не знайдено записів",
            info: "{end} з {rows} записів",
            loading: "Завантаження...",
            infoFiltered: "{info} {end} з {rows} записів (відфільтровано {rowsTotal} записів)"
         },
      });
   </script>
   <script src="{{ asset('/js/index.js') }}"></script>
</body>

</html>