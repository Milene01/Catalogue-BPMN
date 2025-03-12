@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-9"><h3>Extension List</h3></div>
        <div class="col-md-3"><br>
        <a href="{!! url('/publication/list') !!}" class="btn btn-info btn-block">Switch to List View</a>
        </div>
    <div id="people" class="col-md-12"></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Show Details</h4>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="500px" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/ecmascript">
        $(function(){ // let all dom elements are loaded
            $('#myModal').on('hide.bs.modal', function (e) {
                $(this).find('iframe').attr('src',"about:blank");
            });
        });
        $('#people').getOrgChart({
            theme: "annabel",
            color: "neutralgrey",
            scale: 0.6,
            orientation: getOrgChart.RO_LEFT_PARENT_TOP,
            clickEvent: function(sender, args){
                var obj = args;
                var url = "{!! url('publication/treeview/') !!}";
                $('.modal').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3

                    $(this).find('iframe').attr('src',url + '/' + obj.id);
                })
                $('#myModal').modal('show');
                return false;
            },
            primaryColumns: ["short_title", "title", "authors"],
            imageColumn: "image",
            editable: false,
            gridView: false,
            dataSource:{!! $publications !!}
        });
    </script>

@endsection