<x-boost-pdf title="">

    <body style="font-size:<?php echo $leaverequest->leavetype->leave_type_name == 'ลาพักผ่อน' ? '15px' : '14px'; ?>;">
        <div class="container" style="margin-left: 75px;">
            @if ($leaverequest->leavetype->leave_type_name == 'ลาพักผ่อน')
               @include ('leaverequest.valeave')
            @elseif ($leaverequest->leavetype->leave_type_name == 'ลากิจ'|| $leaverequest->leavetype->leave_type_name == 'ลาป่วย')
                @include ('leaverequest.sickleave')
                @else
            @endif
        </div>
    </body>
    </x-bootstrap-pdf>
