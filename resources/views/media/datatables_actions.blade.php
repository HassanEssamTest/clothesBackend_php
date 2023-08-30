<div class='btn-group btn-group-sm'>
  @can('mediaLibrary.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('mediaLibrary.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('mediaLibrary.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.media_edit')}}" href="{{ route('mediaLibrary.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('mediaLibrary.destroy')
{!! Form::open(['route' => ['mediaLibrary.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
