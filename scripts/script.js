//valida Placa e lugares
document.addEventListener("DOMContentLoaded", function() {

    var cadastrarCarroForm = document.querySelector(".cadastrarCarroForm");
    var editarCarroForm = document.querySelector(".editarCarroForm");

    cadastrarCarroForm.addEventListener("submit", function(event) {
    
        if (!validarCadastrarCarroForm()) {
            event.preventDefault();
        }
    });

    editarCarroForm.addEventListener("submit", function(event) {
        if (!validarEditarCarroForm()) {
            event.preventDefault();
        }
    });

    function validarCadastrarCarroForm() {
        var placa = document.getElementById("placa1").value;
        var capacidade = document.getElementById("capacidade1").value;

        if (placa.length !== 7) {
            alert("A placa do veículo deve ter 7 caracteres.");
            return false;
        }

        if (capacidade < 2) {
            alert("A capacidade do veículo deve ser de 2 ou mais lugares.");
            return false;
        }

        return true;
    }

    function validarEditarCarroForm() {
        var placaEditar = document.getElementById("placa").value;
        var capacidadeEditar = document.getElementById("capacidade").value;

        if (placaEditar.length !== 7) {
            alert("A placa do veículo deve ter 7 caracteres.");
            return false;
        }

        if (capacidadeEditar < 2) {
            alert("A capacidade do veículo deve ser de 2 ou mais lugares.");
            return false;
        }
        
        return true;
    }
});

//valida CPF
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('.registersInclude');

    form.addEventListener('submit', function (event) {
        var cpfInput = document.getElementById('cpf1');
        var cpf = cpfInput.value.replace(/[^\d]+/g, ''); 

        if (!validarCPF(cpf)) {
            alert('CPF inválido. Por favor, insira um CPF válido.');
            event.preventDefault(); 
        }
    });

    function validarCPF(cpf) {
        if (cpf.length !== 11) {
            return false;
        }

        var sum = 0;
        var remainder;

        for (var i = 1; i <= 9; i++) {
            sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }

        remainder = (sum * 10) % 11;

        if ((remainder === 10) || (remainder === 11)) {
            remainder = 0;
        }

        if (remainder !== parseInt(cpf.substring(9, 10))) {
            return false;
        }

        sum = 0;
        for (var i = 1; i <= 10; i++) {
            sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }

        remainder = (sum * 10) % 11;

        if ((remainder === 10) || (remainder === 11)) {
            remainder = 0;
        }

        return remainder === parseInt(cpf.substring(10, 11));
    }
});


//Abrir e fechar Sobreposição
document.getElementById('btnFecharSobreposicao').addEventListener('click', function() {
    document.getElementById('sobreposicao').style.display = 'none';
});

document.getElementById('btnAbrirSobreposicao').addEventListener('click', function() {
    document.getElementById('sobreposicao').style.display = 'flex';
});

var btnsRemover = document.querySelectorAll('.btnRemoverCarro');
    btnsRemover.forEach(function (btnRemover) {
        btnRemover.addEventListener('click', function () {

            var carId = btnRemover.getAttribute('data-car-id');
            var confirmacao = confirm('Tem certeza de que deseja remover este carro?');

            if (confirmacao) {
                window.location.href = '../processaCarros.php?acao=3&id=' + carId;
            }
        });
    });

var btnsRemover1 = document.querySelectorAll('.btnRemoverAluno');
    btnsRemover1.forEach(function (btnRemover1) {
        btnRemover1.addEventListener('click', function () {

            var alunoId = btnRemover1.getAttribute('data-aluno-id');
            var confirmacao = confirm('Tem certeza de que deseja remover este Aluno?');

            if (confirmacao) {
                window.location.href = '../processaAlunos.php?acao=3&id=' + alunoId;
            }
        });
    });

var btnsRemover2 = document.querySelectorAll('.btnRemoverAula');
btnsRemover2.forEach(function (btnRemover2) {
    btnRemover2.addEventListener('click', function () {

        var agendaId = btnRemover2.getAttribute('data-agenda-id');
        var confirmacao = confirm('Tem certeza de que deseja remover o agendamento dessa aula?');
        
        if (confirmacao) {
            window.location.href = '../processaAgendamento.php?acao=3&id=' + agendaId;
        }
    });
});


