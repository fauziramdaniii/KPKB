<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $pages
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Events</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <?= $this->Breadcrumb->display($BreadCrumbCrumbs);?>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->


<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('List Events') ?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a id="add-event" href="#<?= $this->Url->build(['action' => 'generate']); ?>" class="btn btn-default btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i>
                                <?= __('Add Events') ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?= $this->Flash->render() ?>

                    <!--begin: Search Form -->
                    <div class="kt-form kt-fork--label-right kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control kt-input" placeholder="Search..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->

                    <!--begin: Calendar -->
                    <div id="kt_calendar"></div>
                    <!--end: Calendar -->

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade"  id="create-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= $this->Url->build(['action' => 'add']); ?>" class="kt-form">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control"  placeholder="Enter Title" maxlength="150" id="title" required />
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"  placeholder="Enter Description" id="description" required></textarea>
                </div>

                <div class="input select form-group">
                    <label>Category</label>
                    <?= $this->Form->control('event_category_id', [
                        'class' => 'form-control selectpicker',
                        'id' => 'category',
                        'options' => $event_categories,
                        'label' => false,
                        'div' => false,
                        'empty' => 'select category'
                    ]); ?>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control"  placeholder="Enter location" maxlength="150" id="location" required />
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" name="start" class="form-control datetimepicker2" required="required"  id="start" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="text" name="end" class="form-control datetimepicker2" required="required" id="end" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Participant</label>
                    <div class="row">
                        <div class="kt-media-group participants col-md-6">
                            <?= __('No participants'); ?>
                        </div>
                        <div class="col-md-6 participant-details">
                            <a class="btn btn-default btn-sm" href="#" style="display: none">
                                View participants
                            </a>
                        </div>
                    </div>
                </div>

                    <input type="hidden" name="event_id" value="" />
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-create-event">Save</button>
                <button type="button" class="btn btn-danger btn-delete-event" style="display: none">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->Html->css([
    '/admin-assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
],['block' => true]);
?>

<!--begin::Page Vendors(used by this page) -->
<?php
$this->Html->script([
    '/admin-assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
    //'/admin-assets/js/pages/components/calendar/event.js',
],['block' => true]);
?>

<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {


        $('.datetimepicker2').datetimepicker({
            todayHighlight: true,
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true
        });

        $('.selectpicker').selectpicker();

        var todayDate = moment().startOf('day');
        //var YM = todayDate.format('YYYY-MM');
        //var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        //var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('kt_calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

            isRTL: KTUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },

            height: 800,
            contentHeight: 750,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' },
                listDay: { buttonText: 'list' },
                listWeek: { buttonText: 'list' }
            },

            defaultView: 'listWeek',
            defaultDate: TODAY,

            editable: true,
            selectable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events: {
                url: '<?= $this->Url->build(); ?>',
                method: 'POST',
                extraParams: function() { // a function that returns an object
                    return {
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                        search: $('#generalSearch').val()
                    };
                }
            },
            eventClick: function(info) {
                $('#create-event')
                    .data('calendar', info.event)
                    .modal('show');
            },
            select: function(cal) {
                $('#create-event')
                    .data('calendar', cal)
                    .modal('show');
            },
            eventDrop: function(event) {
                if (!confirm("Are you sure about this change?")) {
                    event.revert();
                } else {
                    $.ajax({
                        url : '<?= $this->Url->build(['action' => 'moveEvent']);?>',
                        method : 'post',
                        data : {
                            event_id: event.event.id,
                            start: moment(event.event.start).format('YYYY-MM-DD HH:mm:ss'),
                            end: moment(event.event.end).format('YYYY-MM-DD HH:mm:ss'),
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        dataType : 'json',
                        success : function (response) {
                            if (response && response.status && response.status === 'OK') {
                                swal.fire("SUCCESS!", response.message ,"success");
                            }
                        }
                    });
                }
            },
            eventResize: function(event) {
                if (!confirm("Are you sure about this change?")) {
                    event.revert();
                } else {
                    $.ajax({
                        url : '<?= $this->Url->build(['action' => 'moveEvent']);?>',
                        method : 'post',
                        data : {
                            event_id: event.event.id,
                            start: moment(event.event.start).format('YYYY-MM-DD HH:mm:ss'),
                            end: moment(event.event.end).format('YYYY-MM-DD HH:mm:ss'),
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        dataType : 'json',
                        success : function (response) {
                            if (response && response.status && response.status === 'OK') {
                                swal.fire("SUCCESS!", response.message ,"success");
                            }
                        }
                    });
                }
            },
            eventRender: function(info) {
                var element = $(info.el);
                if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', info.event.extendedProps.description);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    }
                }
            }
        });

        calendar.render();

        $('#create-event').on('show.bs.modal', function(e) {
            const data = $(this).data('calendar');
            if (data) {
                let start = moment(data.start).format('YYYY-MM-DD HH:mm');
                let end = moment(data.end).format('YYYY-MM-DD HH:mm');

                if (data.allDay) {
                    let now = moment();
                    start = moment(data.start).set({
                        'hour': now.hour(),
                        'minute': now.minute(),
                    }).format('YYYY-MM-DD HH:mm');

                    end = moment(data.start).set({
                        'hour': now.hour(),
                        'minute': now.minute(),
                    })
                    .add(2, 'hours')
                    .format('YYYY-MM-DD HH:mm');
                }

                if (data.id) {
                    $(this).find('input[name="event_id"]').val(data.id);
                    $(this).find('.btn-delete-event').show();
                }

                if (data.title) {
                    $(this).find('#title').val(data.title);
                }
                if (data.extendedProps && data.extendedProps.description) {
                    $(this).find('#description').val(data.extendedProps.description);
                }

                if (data.extendedProps && data.extendedProps.location) {
                    $(this).find('#location').val(data.extendedProps.location);
                }

                if (data.extendedProps && data.extendedProps.event_category_id) {
                    $(this).find('#category').val(data.extendedProps.event_category_id);
                    $('.selectpicker').selectpicker('refresh');
                }

                //render participant
                if (data.extendedProps && data.extendedProps.participants && data.extendedProps.participants.total > 0) {
                    const defaultAvatar = '<?= $this->Url->build('/member-assets/media/users/default.jpg'); ?>';
                    const pathAvatar = '<?= $this->Url->build('/files/Customers/avatar/'); ?>';
                    let participants = '';
                    data.extendedProps.participants.data.forEach(function(row) {
                        participants += `<a href="#" class="kt-media kt-media--sm kt-media--circle"
                            data-toggle="kt-tooltip" data-skin="brand"
                            data-placement="top" title="${row.name}">
                        <img src="${(row.avatar ? pathAvatar + 'thumbnail-' + row.avatar : defaultAvatar)}" alt="image">
                    </a>`;
                    });

                    if ((data.extendedProps.participants.total - data.extendedProps.participants.data.length) > 0) {
                        const participantMore = data.extendedProps.participants.total - data.extendedProps.participants.data.length;
                        participants += `<a href="#" class="kt-media kt-media--sm kt-media--circle"
                        data-toggle="kt-tooltip" data-skin="brand" data-placement="top"
                        title="">
                        <span>+${participantMore}</span>
                    </a>`;
                    }

                    $('.kt-media-group.participants').html(participants);
                    $('.participant-details a').attr('href', '<?= $this->Url->build(['action' => 'participants']); ?>/' + data.id).show();
                }


                $(this).find('#start').val(start);
                $(this).find('#end').val(end);
            }

        })
        .on('hidden.bs.modal', function(e) {
            $('.kt-media-group.participants').html('<?= __('No participants'); ?>');
            $('.participant-details a').attr('href', '#').hide();
            $(this).removeData('calendar');
            $(this).find('form').get(0).reset();
            $(this).find('input[name="event_id"]').val('');
            $(this).find('.btn-delete-event').hide();
        });

        $('.btn-create-event').click(function() {
            $('#create-event').find('form').on('submit', function submitForm(e) {
               e.preventDefault();
                $(this).off('submit', submitForm);
                const form = $(this);
                const modal = $('#create-event');
                const data = form.serializeArray();
                data.push({
                    name: '_csrfToken',
                    value: '<?= $this->request->getParam('_csrfToken'); ?>'
                })

                let action = '<?= $this->Url->build(['action' => 'add']);?>';

                let event_id = form.find('input[name="event_id"]');
                if (event_id.val() !== '') {
                    action = '<?= $this->Url->build(['action' => 'edit']);?>' + '/' + event_id.val();
                }

                $.ajax({
                    url : action,
                    method : 'post',
                    data : $.param(data),
                    dataType : 'json',
                    success : function (response) {
                        if (response && response.status === 'OK') {
                            swal.fire("SUCCESS!", response.message ,"success");
                            calendar.refetchEvents();
                            modal.modal('hide');
                        } else {
                            swal.fire("ERROR!", response.message ,"error");
                        }
                    }
                });

            }).submit();
        });

        $('.btn-delete-event').on('click', function () {
            if (confirm('Are you sure delete this?')) {
                const event_id = $(this).parents('.modal').find('input[name="event_id"]').val();
                //alert(event_id);
                const modal = $('#create-event');

                $.ajax({
                    url : '<?= $this->Url->build(['action' => 'delete']);?>' + '/' + event_id,
                    method : 'post',
                    data : {
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                    },
                    dataType : 'json',
                    success : function (response) {
                        if (response && response.status === 'OK') {
                            swal.fire("SUCCESS!", response.message ,"success");
                            calendar.refetchEvents();
                            modal.modal('hide');
                        } else {
                            swal.fire("ERROR!", response.message ,"error");
                        }
                    }
                });

            }
        });

        $("#add-event").on('click', function () {
            $('#create-event')
                .modal('show');
        });

        //refetchEvents

        /**
         * Execute a function given a delay time
         *
         * @param {type} func
         * @param {type} wait
         * @param {type} immediate
         * @returns {Function}
         */
        var debounce = function (func, wait, immediate) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };


        $('#generalSearch').on('keyup', debounce(function(){
            calendar.refetchEvents();
        },500));


    });
</script>
<?php $this->end(); ?>



