jQuery(document).ready(function() {
    var context;
    $("#chat").append("<div class=\"texto chatbot\">Olá, Bem vindo a loja do magento. Meu nome é Mag e estou aqui para te auxiliar em suas compras.</div>");
    $("#chat").append("<div class=\"texto chatbot\">Você pode fazer suas compras, saber informações sobre ela, saber sobre a entrega de um produto e muito mais! Sinta-se a vontade para fazer perguntas.</div>");
    $("#mensagem").submit(function(){
        if($("#mensagem #texto").val() === ""){
            $("#chat").append("<div class=\"texto usuario\">...</div>");

            $(".mensagens").animate({scrollTop: $("#chat").height()});
            setTimeout(function(){
                $("#chat").append("<div class=\"texto chatbot\">Eu ainda não aprendi a ler mentes, você precisa digitar alguma coisa para eu poder te ajudar :)</div>");
                $(".mensagens").animate({scrollTop: $("#chat").height()});
            },1000);
            return false;
        }
        $.ajax({
            url: "conversation/retornaDados",
            data: {
                "input": {"text": $("#mensagem #texto").val()},
                "context": context
            },
            dataType: 'json',
            method: 'POST',
            beforeSend: function(){
                $("#chat").append("<div class=\"texto usuario\">" + $("#mensagem #texto").val() + "</div>");
                $(".mensagens").animate({scrollTop: $("#chat").height()});
            },
            success: function(resposta){
                $("#mensagem #texto").val("");
                $("#mensagem #texto").focus();

                context = resposta.context;
                var resp = resposta.output.text;

                if(resposta.error){
                    $("#chat").append("<div class=\"texto chatbot\">" + resposta.error + "</div>");
                    return false;
                }
                var i = 0;
                // console.log(resp[i]);
                function myLoop () {
                    setTimeout(function () {
                        $(".mensagens").animate({scrollTop: $("#chat").height()});
                        $("#chat").append("<div class=\"texto chatbot\">" + resp[i]);

                        i++;
                        if (i < resp.length) {
                            myLoop();
                        }
                    }, 1000)
                }

                myLoop();
            }
        });
        return false;
    });
});

