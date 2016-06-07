package org.model;

import javax.persistence.*;

/**
 * Created by wujiacheng on 16/6/6.
 */
@Entity
@Table(name = "cjb", schema = "stuSys")
@IdClass(CjbEntityPK.class)
public class CjbEntity {

    private String xh;
    private String kch;
    private Integer cj;
    private Integer xf;
    private CjbEntityPK id;

    public CjbEntity(){

    }

    public CjbEntity(CjbEntityPK id) {
        this.id = id;
    }

    public CjbEntity(CjbEntityPK id, Integer cj, Integer xf) {
        this.id = id;
        this.cj = cj;
        this.xf = xf;
    }

    public CjbEntityPK getId() {
        return id;
    }

    public void setId(CjbEntityPK id) {
        this.id = id;
    }

    @Id
    @Column(name = "xh", nullable = false, length = 6)
    public String getXh() {
        return xh;
    }

    public void setXh(String xh) {
        this.xh = xh;
    }

    @Id
    @Column(name = "kch", nullable = false, length = 3)
    public String getKch() {
        return kch;
    }

    public void setKch(String kch) {
        this.kch = kch;
    }

    @Basic
    @Column(name = "cj", nullable = true)
    public Integer getCj() {
        return cj;
    }

    public void setCj(Integer cj) {
        this.cj = cj;
    }

    @Basic
    @Column(name = "xf", nullable = true)
    public Integer getXf() {
        return xf;
    }

    public void setXf(Integer xf) {
        this.xf = xf;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        CjbEntity cjbEntity = (CjbEntity) o;

        if (xh != null ? !xh.equals(cjbEntity.xh) : cjbEntity.xh != null) return false;
        if (kch != null ? !kch.equals(cjbEntity.kch) : cjbEntity.kch != null) return false;
        if (cj != null ? !cj.equals(cjbEntity.cj) : cjbEntity.cj != null) return false;
        if (xf != null ? !xf.equals(cjbEntity.xf) : cjbEntity.xf != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = xh != null ? xh.hashCode() : 0;
        result = 31 * result + (kch != null ? kch.hashCode() : 0);
        result = 31 * result + (cj != null ? cj.hashCode() : 0);
        result = 31 * result + (xf != null ? xf.hashCode() : 0);
        return result;
    }
}
