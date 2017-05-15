<?php defined('IN_IA') or exit('Access Denied');?>                <link href="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
                <style> .ms-container{  width:700px; }  </style>
                <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" ></script>
                <script src="<?php echo MODULE_URL;?>/style/js/jquery.quicksearch.js" ></script>
                <script>
                    $('#pre-selected-options').multiSelect({
                        selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='try \"张三\"'>",
                        selectionHeader: "<input type='text' class='search-input  form-control' autocomplete='off' placeholder='try \"李四\"'>",
                        afterInit: function(ms){
                            var that = this,
                                $selectableSearch = that.$selectableUl.prev(),
                                $selectionSearch = that.$selectionUl.prev(),
                                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function(e){
                            if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                            }
                            });

                            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function(e){
                            if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                            }
                            });
                        },
                        afterSelect: function(){
                            this.qs1.cache();
                            this.qs2.cache();
                        },
                        afterDeselect: function(){
                            this.qs1.cache();
                            this.qs2.cache();
                        }
                    });

                if($("#pre-selected-options-2").length>0){
                    $('#pre-selected-options-2').multiSelect({
                            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='try \"张三\"'>",
                            selectionHeader: "<input type='text' class='search-input  form-control' autocomplete='off' placeholder='try \"李四\"'>",
                            afterInit: function(ms){
                                var that = this,
                                    $selectableSearch = that.$selectableUl.prev(),
                                    $selectionSearch = that.$selectionUl.prev(),
                                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                                .on('keydown', function(e){
                                if (e.which === 40){
                                    that.$selectableUl.focus();
                                    return false;
                                }
                                });

                                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                                .on('keydown', function(e){
                                if (e.which == 40){
                                    that.$selectionUl.focus();
                                    return false;
                                }
                                });
                            },
                            afterSelect: function(){
                                this.qs1.cache();
                                this.qs2.cache();
                            },
                            afterDeselect: function(){
                                this.qs1.cache();
                                this.qs2.cache();
                            }
                        });
                }
                </script>