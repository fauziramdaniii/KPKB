<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer
 */
?>


<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Events'); ?></h5>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center flex-wrap">
        </div>
    </div>
</div>


<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">

        <div class="card card-custom gutter-b card-stretch">
            <div class="card-header pt-6">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder font-size-h5 text-dark-75"><?= __('Events');?></span>
                </h3>
            </div>
            <div class="card-body">
                <div id="kt_calendar"></div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade"  id="create-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= __('Detail Event'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= $this->Url->build(['action' => 'add']); ?>">
                    <div class="form-group">
                        <label><?= __('Title'); ?></label>
                        <input type="text" name="title" class="form-control"  placeholder="<?= __('No title'); ?>" maxlength="150" id="title" readonly />
                    </div>

                    <div class="form-group">
                        <label><?= __('Description'); ?></label>
                        <textarea name="description" class="form-control"  placeholder="<?= __('No description'); ?>" id="description" readonly></textarea>
                    </div>

                    <div class="form-group">
                        <label><?= __('Category'); ?></label>
                        <input type="text" name="event_category_id" class="form-control"  placeholder="<?= __('No Category'); ?>" maxlength="150" id="category" readonly />
                    </div>

                    <div class="form-group">
                        <label><?= __('Location'); ?></label>
                        <input type="text" name="location" class="form-control"  placeholder="<?= __('No location detail'); ?>" maxlength="150" id="location" readonly />
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><?= __('Start Date'); ?></label>
                                <input type="text" name="start" class="form-control datetimepicker2" required="required"  id="start" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><?= __('End Date'); ?></label>
                                <input type="text" name="end" class="form-control datetimepicker2" required="required" id="end" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?= __('Participant'); ?></label>
                        <div>
                            <div class="symbol-group symbol-hover participant-group">
                                <?= __('No participants'); ?>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="event_id" value="" />
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-action-event" data-confirm="1"><?= __('Confirm'); ?></button>
                <button type="button" class="btn btn-primary btn-action-event" data-confirm="2"><?= __('May'); ?></button>
                <button type="button" class="btn btn-danger btn-action-event" data-confirm="3"><?= __('Decline'); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('Close'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->Html->css('/member-assets/css/custom.css', ['block' => true]); ?>
<?php $this->Html->script([
        '/member-assets/plugins/numeral/numeral.min.js',
        '/member-assets/plugins/bootbox/bootbox.all.min.js',
], ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>

    jQuery(document).ready(function() {
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

            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events: {
                url: '<?= $this->Url->build(); ?>',
                method: 'POST',
                extraParams: function() { // a function that returns an object
                    return {
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                        search: $('#generalSearch').val() || ''
                    };
                }
            },
            eventClick: function(info) {
                $('#create-event')
                    .data('calendar', info.event)
                    .modal('show');
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
                    } else if (element.find('.fc-list-item-title').length !== 0) {
                        if (info.view.viewSpec.type === 'listWeek' && info.event.extendedProps.event_category && info.event.extendedProps.event_category.name) {
                            var title = element.find('.fc-list-item-title');
                            title.append('<span style="color: #d1d1d1; display: block; font-size: 11px;">Category: ' + info.event.extendedProps.event_category.name +'</span>');
                        }
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

                const btnActionEvent = $('.btn-action-event');
                btnActionEvent
                    .attr('disabled', false)
                    .css('cursor', 'pointer');

                if (data.extendedProps && data.extendedProps.past) {
                    btnActionEvent.hide();
                }

                if (data.extendedProps && data.extendedProps.attendances && data.extendedProps.attendances.confirm) {
                    const confirm = data.extendedProps.attendances.confirm;
                    //$('[data-confirm="'+confirm+'"]').attr('disabled', true);
                    btnActionEvent.each(function() {
                        if ($(this).data('confirm') === confirm) {
                            $(this).attr('disabled', true)
                            .css({"cursor": "default"});
                        }
                    });
                }

                if (data.extendedProps && data.extendedProps.location) {
                    $(this).find('#location').val(data.extendedProps.location);
                }

                if (data.extendedProps && data.extendedProps.event_category && data.extendedProps.event_category.name) {
                    $(this).find('#category').val(data.extendedProps.event_category.name);
                }

                    //render participant
                if (data.extendedProps && data.extendedProps.participants && data.extendedProps.participants.total > 0) {
                    const defaultAvatar = '<?= $this->Helper->avatar_url(true); ?>';
                    const pathAvatar = '<?= $this->Url->build('/files/Customers/avatar/'); ?>';
                    let participants = '';
                    data.extendedProps.participants.data.forEach(function(row) {
                        participants += `<div class="symbol symbol-30 symbol-circle"
                            data-toggle="kt-tooltip" data-skin="brand"
                            data-placement="top" title="${row.name}">
                        <img src="${(row.avatar ? pathAvatar + 'thumbnail-' + row.avatar : defaultAvatar)}" alt="image">
                    </div>`;
                    });

                    if ((data.extendedProps.participants.total - data.extendedProps.participants.data.length) > 0) {
                        const participantMore = data.extendedProps.participants.total - data.extendedProps.participants.data.length;
                        participants += `<a href="#" class="kt-media kt-media--sm kt-media--circle"
                        data-toggle="kt-tooltip" data-skin="brand" data-placement="top"
                        title="">
                        <span>+${participantMore}</span>
                    </a>`;
                    }

                    $('.participant-group').html(participants);
                }

                if (data.title) {
                    $(this).find('#title').val(data.title);
                }
                if (data.extendedProps && data.extendedProps.description) {
                    $(this).find('#description').val(data.extendedProps.description);
                }



                $(this).find('#start').val(start);
                $(this).find('#end').val(end);
            }

        })
            .on('hidden.bs.modal', function(e) {
                $('.participant-group').html('<?= __('No participants'); ?>');
                //reset
                $('.btn-action-event').show();
                $(this).removeData('calendar');
                $(this).find('form').get(0).reset();
                $(this).find('input[name="event_id"]').val('');
                $(this).find('.btn-delete-event').hide();
            });

        $('.btn-action-event').click(function() {
            const confirmType = $(this).data('confirm');
            $('#create-event').find('form').on('submit', function submitForm(e) {
                e.preventDefault();

                const form = $(this);
                const modal = $('#create-event');
                const data = modal.data('calendar');

                let action = '<?= $this->Url->build(['action' => 'attendance']);?>';

                $.ajax({
                    url : action,
                    method : 'post',
                    data : {
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                        confirm: confirmType,
                        event_id: data.id
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

                $(this).off('submit', submitForm);

            }).submit();
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
