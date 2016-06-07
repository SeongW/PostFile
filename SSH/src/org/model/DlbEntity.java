package org.model;

import javax.persistence.*;

/**
 * Created by wujiacheng on 16/6/6.
 */
@Entity
@Table(name = "dlb", schema = "stuSys")
public class DlbEntity {
    private int id;
    private String xh;
    private String kl;

    @Id
    @Column(name = "id", nullable = false)
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    @Basic
    @Column(name = "xh", nullable = false, length = 6)
    public String getXh() {
        return xh;
    }

    public void setXh(String xh) {
        this.xh = xh;
    }

    @Basic
    @Column(name = "kl", nullable = false, length = 20)
    public String getKl() {
        return kl;
    }

    public void setKl(String kl) {
        this.kl = kl;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        DlbEntity dlbEntity = (DlbEntity) o;

        if (id != dlbEntity.id) return false;
        if (xh != null ? !xh.equals(dlbEntity.xh) : dlbEntity.xh != null) return false;
        if (kl != null ? !kl.equals(dlbEntity.kl) : dlbEntity.kl != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = id;
        result = 31 * result + (xh != null ? xh.hashCode() : 0);
        result = 31 * result + (kl != null ? kl.hashCode() : 0);
        return result;
    }
}
