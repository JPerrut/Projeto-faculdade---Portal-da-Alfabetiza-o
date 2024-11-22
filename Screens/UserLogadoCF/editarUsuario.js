function editarUsuario(id, nome_func, email, data_nasc, cpf, rg, sexo, escolaridade, turno, cep, estado, cidade, bairro, rua, numero, complemento) {
  document.getElementById('id_funcionario').value = id;
  document.getElementById('nome_func').value = nome_func;
  document.getElementById('email').value = email;
  document.getElementById('data_nasc').value = data_nasc;
  document.getElementById('cpf').value = cpf;
  document.getElementById('rg').value = rg;
  document.getElementById('sexo').value = sexo;
  document.getElementById('escolaridade').value = escolaridade;
  document.getElementById('turno').value = turno;
  document.getElementById('cep').value = cep;
  document.getElementById('estado').value = estado;
  document.getElementById('cidade').value = cidade;
  document.getElementById('bairro').value = bairro;
  document.getElementById('rua').value = rua;
  document.getElementById('numero').value = numero;
  document.getElementById('complemento').value = complemento;
}

// Timeout para ocultar a mensagem de feedback após 5 segundos com efeito de fade-out
setTimeout(function() {
  var feedbackMsg = document.getElementById('feedback');
  if (feedbackMsg) {
      feedbackMsg.classList.add('fade-out'); // Adiciona a classe que aplica o fade-out
  }
}, 5000);
