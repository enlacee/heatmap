    var ObjHeadMap = {
        statusTimer : true,        
        arraySlot :'',
        init : function() {
            console.log("init SLOT");
            this.listOption();
            this.loadDataSecuencial();
            
            this.btnSave();
            this.btnSaveRange();
        },
        // 03 : load data if statusTimer = true
        loadDataSecuencial : function() {
            var status = Slot.statusTimer;
            if (status) {
                setTimeout(function() {
                    console.log("time", "TIMER = " + status);
                    //alert("antes de UPDATE DATABASE");
                    Slot.loadTimer();
                    Slot.loadDataSecuencial();
                }, 1000);
            } else {
                setTimeout(function() {
                    console.log("time", "TIMER = " + status);
                    Slot.loadDataSecuencial();
                }, 1000);
            }
        },
        loadTimer : function() {    
            var arraySlot = Slot.arraySlot;            
            var parametro = arrayToString(arraySlot);
            $.ajax({
                url: 'parametros.php',                
                data : {op : 'listaPorSlot', slot : parametro},
                type: 'GET',
                dataType: 'json',
                success: function (rs){
                    var data = rs[0];
                    var name = 'slot_';
                    var array = arraySlot;
                    var contador = 1;
                    for (var i=0; i<array.length; i++) {
                        var node = $("#"+contador).children();
                        node.padre = $("#"+contador);
                        var named = name+array[i][contador];
                        node[2].innerHTML = show_props(data, named) || '-';
                        Slot.ayuda_colorSlot(node);
                        contador++;
                    }
                }
            });
        },
        // Cargar combo box (slots que existen)
        listOption : function() {            
            $(vars.param_parameter).attr('disabled',true);            
            $.ajax({
                url: 'parametros.php',
                data : {op : 'listaCombo_json'},
                type: 'GET',
                dataType: 'json',
                success: function (data){                   
                    $.each(data, function(key, value) {
                        $(vars.param_parameter)
                            .append($("<option></option>")
                            .attr("value", value.slot)
                            .text(value.name)); 
                    });                    
                    $(vars.param_parameter).attr('disabled',false);
                }
            });
            
            // LISTENER DESPUES DE CREAR LOS OBJETOS
            $(".slot").unbind();
            $(".slot").bind('click',function() {
                $(vars.key).val($(this).attr('id'));
                $(vars.param_parameter_antes).val($(this).attr('data-slot'));
                $(vars.param_parameter).val($(this).attr('data-slot'));
                Slot.statusTimer = false;
            });
            $(".close, #btnClose, #myModal").unbind();
            $(".close, #btnClose, #myModal").bind('click', function() {
                Slot.statusTimer = true;
            });            
        },

        // clar variables del formulario
        clearForm: function() {             
            $(vars.param_parameter).val('');
            $(vars.param_alarMin).val('');
            $(vars.param_alarMax).val('');
            $(vars.param_background).val('');
            $(vars.param_text_color).val('');
        },
        // Evento ah iniciar al cargar el Dom
        btnSave : function() {
            $(vars.btn_save).unbind();
            $(vars.btn_save).bind('click', function() {
                Slot.eventSave();
            });
        },
        btnSaveRange : function() {
            $(vars.btn_saveRange).unbind();
            $(vars.btn_saveRange).bind('click', function() {
                var slot = Slot.eventSave();
                Slot.ayuda_updateSlot(slot);
            });
        },
        eventSave : function () {
            var id = $(vars.key).val();               
            var node = $("#"+id).children();                
            //DATA
            var array = new Array();
            array.key = $(vars.key).val();                
            array.slot = $(vars.param_parameter).val();
            array.name = $(vars.param_parameter+" option:selected").text();
            array.min = $(vars.param_alarMin).val() || 0;
            array.max = $(vars.param_alarMax).val() || 0;
            array.background = $(vars.param_background).val()|| '#DE0002';
            array.textColor = $(vars.param_text_color).val()|| '#000000';
            //ENDDATA

            $("#"+id).attr('data-slot', array.slot);                
            node[0].innerHTML = array.name;
            node[1].innerHTML = array.slot;
            node[2].innerHTML = '-';
            node[4].children[0].innerHTML = array.min;
            node[4].children[1].innerHTML = array.max;
            node[5].innerHTML = array.background;
            node[6].innerHTML = array.textColor;
            //CAMBIAR LA PETICION
            var arraySlot = Slot.arraySlot; // arraySlot[0][1]
            arraySlot[(id-1)][id] = array.slot;

            Slot.clearForm();
            return array;            
        },
        // en desarrollo para actualizar datos de slot.
        ayuda_updateSlot : function(slot){ alert ("antes ajac");
            $.ajax({
                url: vars.url,
                data : {op : 'update_parametros', idSlot : slot.slot, min:slot.min ,max:slot.max},
                type: 'GET',
                dataType: 'json',
                success: function (data){

                }
            });
        },
        ayuda_colorSlot : function(node) {
            var slotValor = parseFloat(node[2].textContent); slotValor = !isNaN(slotValor) ? slotValor : 0;
            var slotMin = parseFloat(node[4].children[0].textContent);
            var slotMax = parseFloat(node[4].children[1].textContent);
            var slotBackground = node[5].textContent;            
            var slotTextColor = node[6].textContent;            
            //CAMBIAR DE COLOR            
            if ( slotValor >  slotMin ) {
                if (slotValor > slotMax) {
                    node.padre[0].style.backgroundColor = slotBackground;
                    node[2].style.color = slotTextColor;
                }
            } else {
                    node.padre[0].style.backgroundColor = '#0000AA';
                    node[2].style.color = '#ffffff';                
            }
        }
    };