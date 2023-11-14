1. Os migrations foram testados e atualizados, a tabela de materiais_devolvidos foi excluída.
    -foi atualizado o nome de materiais para materiais estoque
    -foi adicionado o enum para especificar o estado do material 
2. Os models foram corrigidos e os relacionamentos com materiais_devolvidos foi excluído.
    -Como dito, materiais devolvidos foi excluído, agora possui um pivot para especificar que o 'quantidade' descrito em lista_materiais_necessarios é um atributo adicionado pelo relacionamento entre materiais_estoque e obras.
    -Os relacionamentos entre materiais_devolvidos e as outras classes também foi excluído.
