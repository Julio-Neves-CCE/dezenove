# Exemplo de dados fornecidos com espaços extras
dados = [


]

# Formatação para remover espaços extras e adicionar vírgula no final de cada linha
dados_formatados = [f"('{item[0].strip()}','{item[1].strip()}','{item[2].strip()}','{item[3].strip()}')," for item in dados]

# Exibe os dados formatados
for linha in dados_formatados:
    print(linha)
