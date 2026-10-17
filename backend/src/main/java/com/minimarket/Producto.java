package com.minimarket;

import jakarta.persistence.*;
import jakarta.validation.constraints.*;
import java.math.BigDecimal;
import java.time.LocalDate;

@Entity
@Table(name = "Producto")
public class Producto {
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    @NotBlank
    @Column(nullable = false, length = 100)
    private String nombre;

    @NotBlank
    @Column(nullable = false, length = 100)
    private String proveedor;

    @NotNull
    @Column(name = "fecha_vencimiento", nullable = false) // <-- Mapeo exacto a la BD
    private LocalDate fechaVencimiento;

    @NotNull
    @DecimalMin("0.0")
    @Column(nullable = false, precision = 10, scale = 2)
    private BigDecimal precio;

    @NotNull
    @Min(0)
    @Column(nullable = false)
    private Integer stock;

    @Column(nullable = false)
    private Integer eliminado = 0;

    // ===== GETTERS Y SETTERS =====
    
    public Integer getId() { 
        return id; 
    }
    public void setId(Integer id) { 
        this.id = id; 
    }

    public String getNombre() { 
        return nombre; 
    }
    public void setNombre(String nombre) { 
        this.nombre = nombre; 
    }

    public String getProveedor() { 
        return proveedor; 
    }
    public void setProveedor(String proveedor) { 
        this.proveedor = proveedor; 
    }

    public LocalDate getFechaVencimiento() { 
        return fechaVencimiento; 
    }
    public void setFechaVencimiento(LocalDate fechaVencimiento) { 
        this.fechaVencimiento = fechaVencimiento; 
    }

    public BigDecimal getPrecio() { 
        return precio; 
    }
    public void setPrecio(BigDecimal precio) { 
        this.precio = precio; 
    }

    public Integer getStock() { 
        return stock; 
    }
    public void setStock(Integer stock) { 
        this.stock = stock; 
    }

    public Integer getEliminado() { 
        return eliminado; 
    }
    public void setEliminado(Integer eliminado) { 
        this.eliminado = eliminado; 
    }
}