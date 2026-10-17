package com.minimarket;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import java.util.List;

@Repository
public interface ProductoRepository extends JpaRepository<Producto, Integer> {
    
    // Busca los productos filtrando por el campo 'eliminado' (0 = activos, 1 = eliminados)
    List<Producto> findByEliminado(Integer eliminado);
    
}