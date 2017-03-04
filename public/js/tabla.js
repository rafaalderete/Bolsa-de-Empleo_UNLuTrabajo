        (function(){
            'use strict';
            var $ = jQuery;
            $.fn.extend({
                filterTable: function(){
                    return this.each(function(){
                        $(this).on('keyup', function(e){
                            $('.filterTable_no_results').remove();
                            var $this = $(this), 
                                search = $this.val().toLowerCase(), 
                                target = $this.attr('data-filters'), 
                                $target = $(target), 
                                $rows = $target.find('tbody tr');
                                
                            if(search == '') {
                                $rows.show(); 
                            } else {
                                $rows.each(function(){
                                    var $this = $(this);
                                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                })
                            }
                        });
                    });
                }
            });
            $('[data-action="filter"]').filterTable();
        })(jQuery);

        $(function(){
            // attach table filter plugin to inputs
            $('[data-action="filter"]').filterTable();
            
            $('.container-fluid').on('click', '.box-header span.filter', function(e){
                var $this = $(this), 
                    $panel = $this.parents('.box');
                
                $panel.find('.panel-body').slideToggle();
                if($this.css('display') != 'none') {
                    $panel.find('.panel-body input').focus();
                }
            });
            $('[data-toggle="tooltip"]').tooltip();
        })