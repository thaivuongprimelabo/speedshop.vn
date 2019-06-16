@if(isset($url_remove))
<td align="center"><a href="javascript:void(0)" data-url="{{ $url_remove }}" class="remove-row" title="Remove"><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i></a></td>
@endif
@if(isset($url_edit))
<td align="center"><a href="javascript:void(0)" data-url="{{ $url_edit }}" class="edit" title="Edit"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 24px"></i></a></td>
@endif