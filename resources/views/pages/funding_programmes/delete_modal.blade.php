<div class="modal fade" id="deleteFundingProgrammeModal{{$fundingProgramme->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{trans('funding_programmes.deleteFundingProgrammeModal.title')}}</h4>
            </div>
            <div class="modal-body">
                {{trans('funding_programmes.deleteFundingProgrammeModal.body', ['name' => $fundingProgramme->name])}}
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary"
                   href="{{url('funding_programmes/'.$fundingProgramme->id.'/delete')}}"
                >{{trans('layout.buttons.delete')}}</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('layout.buttons.cancel')}}</button>
            </div>
        </div>
    </div>
</div>