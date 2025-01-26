<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Satisfação - Fribal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #0056b3;
        }
       .Contato {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 12px;
        /* Permite que os contatos se movam para a linha de baixo em telas menores */
      }
      .divcontato {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .divcontato img {
        width: 40px;
        height: 40px;
        margin-bottom: 7px;
      }

      .divcontato a {
        color: white;
        text-decoration: none;
        font-size: 16px;
      }

      .divcontato a:hover {
        text-decoration: underline;
      }

      .file-count {
        margin-top: 20px;
      }


        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pesquisa de Satisfação - Fribal</h1>
        <form method="POST" action="processa_voto.php">
            <label for="nome">Seu Nome:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="loja">Selecione a Loja:</label>
            <select name="loja" id="loja" required>
                <option value="">Selecione</option>
                <option value="Bom vizinho Panamericano">Bom vizinho Panamericano</option>
                <option value="Loja A">Loja A</option>
                <option value="Loja B">Loja B</option>
                <option value="Loja C">Loja C</option>
                <option value="Bom vizinho Messejana">Bom vizinho Messejana</option>
                <option value="Loja D">Loja D</option>
                <option value="Loja E">Loja E</option>
                <option value="Loja F">Loja F</option>
            </select>

            <label for="nota">Nota (0-10):</label>
            <input type="number" name="nota" id="nota" min="0" max="10" required>

            <button type="submit">Enviar Voto</button>
        </form>
        <footer>
          <h1>EQUIPE PARA CONTATO</h1>
         <div class="Contato">
            <div class="divcontato">
              <a href="http://api.whatsapp.com/send?phone=558500000000" target="_blank">
                <img src="https://logospng.org/download/whatsapp/logo-whatsapp-512.png" alt="WhatsApp Teste" />
              </a>
              <div>
                ABDIR
             </div>
            </div>
            <div class="divcontato">
              <a href="http://api.whatsapp.com/send?phone=5585900000" target="_blank">
                <img src="https://logospng.org/download/whatsapp/logo-whatsapp-512.png" alt="WhatsApp Teste" />
              </a>
              <div>RENO</div>
            </div>
          <div class="divcontato">
              <a href="http://api.whatsapp.com/send?phone=55859900000" target="_blank">
                <img src="https://logospng.org/download/whatsapp/logo-whatsapp-512.png" alt="WhatsApp Teste"
              />
              </a>
              <div>
                AULO
              </div>
            </div>
          </div>
          <p style="text-align: center;">&copy; 2025 Tidal - Fortaleza</p>
        </footer>
    </div>
</body>
</html>
